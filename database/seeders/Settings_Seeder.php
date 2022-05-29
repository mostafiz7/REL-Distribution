<?php

namespace Database\Seeders;

use App\Models\Settings_Model;
use Illuminate\Database\Seeder;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class Settings_Seeder extends Seeder
{
  /**
   * Run the database seeds.
   * @return void
   */
  public function run()
  {
    // Seeder run command
    // php artisan db:seed --class=Settings_Seeder
    

    $address = [
      'address_1'    => 'Address-1',
      'address_2'    => null,
      'avenue'       => 'Avenue',
      'city'         => 'City',
      'state'        => 'State/County',
      'postcode'     => 'Postcode',
      'country'      => 'Country Name',
    ];

    
    /* $payment_config = [
      'ssl-commerz' => [
        'id'            => 1,
        'gateway'       => 'SSL-Commerz',
        'active'        => false,
        'email'         => null,
        'api_key'       => null,
        'api_secret'    => null,
        // 'api_password'  => null,
      ],
      'paypal' => [
        'id'            => 2,
        'gateway'       => 'PayPal',
        'active'        => false,
        'email'         => null,
        'api_key'       => null,
        'api_secret'    => null,
        // 'api_password'  => null,
      ]
    ]; */


    $mail_config = [
      'queue_connection'      => 'database',
      'mail_mailer'           => 'smtp',
      'mail_host'             => 'smtp.mailtrap.io',
      'mail_port'             => '2525',
      'mailgun_domain'        => null,
      'mailgun_secret_api'    => null,
      'mailgun_endpoint'      => null,
      'encryption_type'       => 'tls',
      'mail_username'         => null,
      'mail_password'         => null,
      'mail_from_address'     => null,
      'mail_from_name'        => null,
      'mail_replyTo_address'  => null,
      'mail_replyTo_name'     => null,
    ];
    DotenvEditor::setKeys([
      'QUEUE_CONNECTION'      => $mail_config['queue_connection'],
      'MAIL_MAILER'           => $mail_config['mail_mailer'],
      'MAIL_HOST'             => $mail_config['mail_host'],
      'MAIL_PORT'             => $mail_config['mail_port'],
      'MAILGUN_DOMAIN'        => $mail_config['mailgun_domain'],
      'MAILGUN_SECRET'        => $mail_config['mailgun_secret_api'],
      'MAILGUN_ENDPOINT'      => $mail_config['mailgun_endpoint'],
      'MAIL_ENCRYPTION'       => $mail_config['encryption_type'],
      'MAIL_USERNAME'         => $mail_config['mail_username'],
      'MAIL_PASSWORD'         => $mail_config['mail_password'],
      'MAIL_FROM_ADDRESS'     => $mail_config['mail_from_address'],
      'MAIL_FROM_NAME'        => $mail_config['mail_from_name'],
      'MAIL_REPLY_TO_ADDRESS' => $mail_config['mail_replyTo_address'],
      'MAIL_REPLY_TO_NAME'    => $mail_config['mail_replyTo_name'],
    ])->save();


    $sms_config = [
      'channel'     => null,
      'api_key'     => null,
      'api_secret'  => null,
      'sms_number'  => null,
    ];
    DotenvEditor::setKeys([
      'NEXMO_KEY'       => $sms_config['api_key'],
      'NEXMO_SECRET'    => $sms_config['api_secret'],
      'NEXMO_SMS_FROM'  => $sms_config['sms_number'],
    ])->save();


    /* $order_process = [
      'enable'             => 1,
      'applicable_city'    => 'all',
      'distance'           => 15,
      'delivery_charge'    => FormatedFloat(4),
      'min_order_delivery' => FormatedFloat(35),
      'min_order_discount' => FormatedFloat(50),
      'discount_cash'      => FormatedFloat(0),
      'discount_percent'   => FormatedFloat(10),
      'processing_fee'     => FormatedFloat(2),
      'email_from'         => 'admin@example.com',
      'email_replyTo'      => 'admin@example.com',
      'email_cc'           => null,
      'email_bcc'          => null,
    ]; */


    /* $invoice_config = [
      'title'           => 'bill',
      'series'          => 'year',
      'sequence'        => 'auto',
      'serial_format'   => '{SERIES}/{SEQUENCE}',
      'invoice_date'    => null,
      'date_format'     => 'd-M-y',
      'currency_format' => '{SYMBOL}{VALUE}',
      'notes'           => null,
    ]; */
    

    Settings_Model::create([
      'site_title'              => 'Rangs Electronics Ltd.',
      'tagline'                 => 'No.1 Electronics Company in Bangladesh',
      'site_url'                => 'http://distribution.test',
      'company_name'            => 'Rangs Electronics Ltd.',
      'company_slogan'          => 'No.1 Electronics Company in Bangladesh',
      'company_email'           => 'info@example.com',
      'company_contact'         => '01700000000, 07500000000',
      'company_address'         => $address,
      'vat_no'                  => null,
      'business_id'             => null,
      'currency_sign'           => '৳',
      'currency_code'           => 'BDT',
      'currency_fraction'       => 'poysha',
      'sms_service'             => false,
      'new_user_register'       => false,
      'new_user_role'           => 5,
      'site_language'           => null,
      'timezone'                => 'Asia/Dhaka',
      'date_format'             => 'd-M-Y',
      'time_format'             => 'h:i A',
      'office_hour_start'       => null,
      'office_hour_end'         => null,
      'office_hours'            => null,
      'week_start'              => null,
      'weekly_holiday'          => null,
      'general_holiday'         => null,
      'yearly_holiday'          => null,
      'mail_config'             => $mail_config,
      'sms_config'              => $sms_config,
      'google_maps'             => null,
      'user_settings'           => null,
      'notification_settings'   => null,
      'employee_settings'       => null,
      'department_settings'     => null,
      'designation_settings'    => null,
      'requisition_settings'    => null,
      'bill_settings'           => null,
      'company_settings'        => null,
      'branch_settings'         => null,
      'branch_office_settings'  => null,
      'factory_settings'        => null,
      'distribution_settings'   => null,
      'sales_settings'          => null,
      'pos_settings'            => null,
      'outlet_settings'         => null,
      'purchase_settings'       => null,
      'vehicle_settings'        => null,
      'parts_settings'          => null,
      'category_settings'       => null,
      'brand_settings'          => null,
    ]);
  }

}
