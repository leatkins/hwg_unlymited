<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class MailOrderController extends Controller
{
    public int $orderId;
    public Customer $customer;
    private Order $order;
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
        $this->order = Order::find($orderId);
        $this->customer = Customer::find($this->order->customer_id);
    }

    public function sendMail()
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = env('MAIL_HOST', 'mail.hwg-unlymited.com');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME');                     //SMTP username
            $mail->Password   = env('MAIL_PASSWORD');                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = env('MAIL_PORT');                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('orders@hwg-unlymited.com', 'HWG-Unlymited');
            $mail->addAddress($this->customer->email_address, $this->customer->first_name . ' ' . $this->customer->last_name);     //Add a recipient
            $mail->addBCC('orders@hwg-unlymited.com');


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'New Pending Order : ' . $this->order->confirmation_number;
            $mail->Body    = <<<EOD
            
<h1>Thank you for choosing HWG-Unlymited</h1>
<p>
    <a href="https://hwg-unlymited.com/"><strong>www.HWG-UNLYMITED.com</strong></a>
</p>
<br />
<p>We appreciate your business</p>
<p>See attachment for order details</p>
<hr />
<hr />

<strong>(Here We Grow UnLymited-HWG)</strong> Fragrances have no affiliation with designers nor
manufacturers with our oil types.
(HWG) (Fragrance oil types consist of essential oil mixtures to smell similar, but are not the
original colognes or perfumes. It is a perfume oil version of a designer scent only. </p>
<p>The designer name(s) are trademarked and belong to the original manufacturer. The copyrights and
trademarks do not belong to <strong>(HWG)</strong> Fragrances but to the manufacturer(s) and/or
designer(s). We do not claim that our oils are the originals, only to be compared.</p>
<p><strong>(HWG)</strong> Fragrances have no intention to mislead the customer into believing that
our oils are original, or to infringe on the manufacture(s) or designer(s) name. </p>

<br />

<p>
Our website <strong>(HWG)</strong> is in compliance with the Federal Trade Commission’s
statement of policy regarding comparative advertising.
Directions for use of roll on: Place bottle in one hand and in the palm of the other hand, in a
tilted position roll the ball in a circular motion to distribute fragrance.
Do not: Roll or spray directly onto clothing. These body oils are not meant to be applied
directly to clothing (especially fragile fabrics such as silk and satin.)
Improper use: Laying bottle on side, upside down for an extended period of time, placing bottles
in direct heat, rolling the ball against body extremities excessively instead of in the palm of
your hand, and not closing securely.
</p>
EOD;
            $attachment = $this->writeTextFile();
            $mail->addAttachment($attachment);
            $mail->send();
            Storage::delete($attachment);
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function writeTextFile() : string
    {
        $orderConfirmation = 'Confirmation #: ' . $this->order->confirmation_number . "\n";
        $customerName = '--- Customer --- ' . "\n" . $this->customer->first_name . ' ' . $this->customer->last_name . "\n" ;
        $shippingAddress = $this->order->address_1 . ' '.  $this->order->address_2 . "\n";
        $shippingCityStateZip = $this->order->city . ', ' . $this->order->state . ' ' . $this->order->zip_code . "\n\n";

        $amount = 'Amount Paid: $'. number_format($this->order->amount, 2) . "\n\n";

       $orderFile = $orderConfirmation . $customerName . $shippingAddress . $shippingCityStateZip . $amount . "--- Items Ordered --- \n";

        $lineItems = DB::table('order_line_items')
            ->join('products', 'order_line_items.product_id', '=', 'products.id')
            ->where('order_line_items.order_id', '=', $this->orderId)
            ->get();

             

        foreach ($lineItems as $lineItem) {
            $row = "Qty($lineItem->quantity) ". $lineItem->name . ' | ' . $lineItem->description . ' | ' .  number_format($lineItem->line_price, 2) . "\n";
            $orderFile .= $row;
        }
        
        $fileName = 'HWG-Unlymited_CO-' . $this->order->confirmation_number. '.txt';
        Storage::disk('public')->put($fileName, $orderFile);
        return 'public/storage/'. $fileName; 
    }
}
