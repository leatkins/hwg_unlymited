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
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = env('MAIL_HOST');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME');                     //SMTP username
            $mail->Password   = env('MAIL_PASSWORD');                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('orders@hwg-unlymited.com', 'HWG-Unlymited');
            $mail->addAddress($this->customer->email_address, $this->customer->first_name . ' ' . $this->customer->last_name);     //Add a recipient
            $mail->addBCC('orders@hwg-unlymited.com');


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'New Pending Order : ' . $this->order->confirmation_number;
            $mail->Body    = "<h1>Thank you for choosing HWG-Unlymited</h1><p>We appreciate your business</p><p>See attachment for order details</p>";
            $attachment = $this->writeTextFile();
            $mail->addAttachment('app/storage/' . $attachment);
            dd($mail);
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function writeTextFile() : string
    {
        $orderConfirmation = 'Confirmation #: ' . $this->order->confirmation_number . "\n";
        $customerName = 'Customer: ' . $this->customer->first_name . ' ' . $this->customer->last_name . "\n" ;
        $shippingAddress = $this->order->address_1 . ' '.  $this->order->address_2 . "\n";
        $shippingCityStateZip = $this->order->city . ', ' . $this->order->state . ' ' . $this->order->zip_code . "\n\n";

        $amount = 'Amount Paid: $'. $this->order->amount . "\n\n";

       $orderFile = $orderConfirmation . $customerName . $shippingAddress . $shippingCityStateZip . $amount;

        $lineItems = DB::table('order_line_items')
            ->join('products', 'order_line_items.product_id', '=', 'products.id')
            ->where('order_line_items.order_id', '=', $this->orderId)
            ->get();

        foreach ($lineItems as $lineItem) {
            $row = "Qty($lineItem->quantity) ". $lineItem->name . ' | ' . $lineItem->description . ' | ' .  number_format($lineItem->line_price, 2);
            $orderFile .= $row;
        }

        $fileName = 'HWG-Unlymited_CO-' . $this->order->confirmation_number. '.txt';
        Storage::put($fileName, $orderFile);
        return $fileName;
    }
}
