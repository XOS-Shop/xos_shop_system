<?php
////////////////////////////////////////////////////////////////////////////////
// project    : XOS-Shop, open source e-commerce system
//              http://www.xos-shop.com
//                                                                     
// filename   : mailer.php
// author     : Hanspeter Zeller <hpz@xos-shop.com>
// copyright  : Copyright (c) 2014 Hanspeter Zeller
// license    : This file is part of XOS-Shop.
//
//              XOS-Shop is free software: you can redistribute it and/or modify
//              it under the terms of the GNU General Public License as published
//              by the Free Software Foundation, either version 3 of the License,
//              or (at your option) any later version.
//
//              XOS-Shop is distributed in the hope that it will be useful,
//              but WITHOUT ANY WARRANTY; without even the implied warranty of
//              MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//              GNU General Public License for more details.
//
//              You should have received a copy of the GNU General Public License
//              along with XOS-Shop.  If not, see <http://www.gnu.org/licenses/>.
////////////////////////////////////////////////////////////////////////////////

  require('PHPMailerAutoload.php');

  class mailer extends PHPMailer {
    // Set default variables for all new objects
    public $From     = 'from@example.com';
    public $FromName = 'Mailer';
    public $Host     = 'smtp1.example.com;smtp2.example.com';
    public $Mailer   = 'smtp';
    public $WordWrap = 100;

    public function mailer($to_name = '', $to_email_address = '', $email_subject = '', $body_html = '', $body_plain = '', $from_email_name = '', $from_email_address = '', $embedded_shop_logo = '', $attachments = '')
    {  
       
      $this->setLanguage($_SESSION['language'], DIR_FS_SMARTY . 'admin/languages/' . $_SESSION['language'] . '/');
      
      $this->CharSet = CHARSET;
          
      $this->Mailer = EMAIL_TRANSPORT;
      
      $this->Sendmail = SENDMAIL_PATH;
      
      $this->Host = SMTP_HOST;
      $this->SMTPAuth = SMTP_AUTH;
      $this->SMTPSecure = SMTP_SECURE;      
      $this->Username = SMTP_USERNAME;
      $this->Password = SMTP_PASSWORD;
      
      if ($from_email_address != '') {
        $this->From = $from_email_address;
        $this->FromName = $from_email_name;
      }
      
      if ($to_email_address != '') {
        $this->addAddress($to_email_address, $to_name);
      }
       
      if ($email_subject != '') { 
        $this->Subject = $email_subject;
      }
      
      if (EMAIL_USE_HTML == 'true' && $body_html != '') { 
        $this->isHTML(true);
        
        if ($embedded_shop_logo != '') {
          $this->addEmbeddedImage(DIR_FS_CATALOG . (is_file(DIR_FS_CATALOG . 'images/email_shop_logo/' . $embedded_shop_logo) ? 'images/email_shop_logo/' : 'images/catalog/templates/' . DEFAULT_TPL . '/') . $embedded_shop_logo, 'shop_logo', '', 'base64', 'image/' . substr(strrchr($embedded_shop_logo, '.'), 1));
        } 
         
        $this->Body = $body_html;
        $this->AltBody = html_entity_decode(strip_tags($body_plain), ENT_QUOTES, 'UTF-8');
      } elseif ($body_plain != '') {
        $this->isHTML(false);
        $this->Body = html_entity_decode(strip_tags($body_plain), ENT_QUOTES, 'UTF-8');
      }
      
      if ($attachments != '') {
        $attachs = explode(';', $attachments);
        for ($i=0, $n=count($attachs); $i<$n; $i++) {
          $this->addAttachment(DIR_FS_CATALOG . trim($attachs[$i]));
        }      
      }      
    }
    
    /**
     * Die folgenden zwei Methoden ersetzen die Originale, weil diese
     * bezueglich mixed, related und alternative fehlerhaft sind.
     * /              
    
    /**
     * Get the message MIME type headers.
     * @access public
     * @return string
     */
    public function getMailMIME()
    {
        $result = '';
        switch ($this->message_type) {
            case 'inline':
            case 'alt_inline':            
                $result .= $this->headerLine('Content-Type', 'multipart/related;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            case 'attach':
            case 'inline_attach':
            case 'alt_attach':
            case 'alt_inline_attach':
                $result .= $this->headerLine('Content-Type', 'multipart/mixed;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            case 'alt':
                $result .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            default:
                // Catches case 'plain': and case '':
                $result .= $this->textLine('Content-Type: ' . $this->ContentType . '; charset=' . $this->CharSet);
                break;
        }
        //RFC1341 part 5 says 7bit is assumed if not specified
        if ($this->Encoding != '7bit') {
            $result .= $this->headerLine('Content-Transfer-Encoding', $this->Encoding);
        }

        if ($this->Mailer != 'mail') {
            $result .= $this->LE;
        }

        return $result;
    }
    
    /**
     * Assemble the message body.
     * Returns an empty string on failure.
     * @access public
     * @throws phpmailerException
     * @return string The assembled message body
     */
    public function createBody()
    {
        $body = '';

        if ($this->sign_key_file) {
            $body .= $this->getMailMIME() . $this->LE;
        }

        $this->setWordWrap();

        switch ($this->message_type) {
            case 'inline':
                $body .= $this->getBoundary($this->boundary[1], '', '', '');
                $body .= $this->encodeString($this->Body, $this->Encoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[1]);
                break;
            case 'attach':
                $body .= $this->getBoundary($this->boundary[1], '', '', '');
                $body .= $this->encodeString($this->Body, $this->Encoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'inline_attach':
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], '', '', '');
                $body .= $this->encodeString($this->Body, $this->Encoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'alt':
                $body .= $this->getBoundary($this->boundary[1], '', 'text/plain', '');
                $body .= $this->encodeString($this->AltBody, $this->Encoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->getBoundary($this->boundary[1], '', 'text/html', '');
                $body .= $this->encodeString($this->Body, $this->Encoding);
                $body .= $this->LE . $this->LE;
                if (!empty($this->Ical)) {
                    $body .= $this->getBoundary($this->boundary[1], '', 'text/calendar; method=REQUEST', '');
                    $body .= $this->encodeString($this->Ical, $this->Encoding);
                    $body .= $this->LE . $this->LE;
                }
                $body .= $this->endBoundary($this->boundary[1]);
                break;
            case 'alt_inline':
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;                
                $body .= $this->getBoundary($this->boundary[2], '', 'text/plain', '');
                $body .= $this->encodeString($this->AltBody, $this->Encoding);
                $body .= $this->LE . $this->LE;                                                
                $body .= $this->getBoundary($this->boundary[2], '', 'text/html', '');
                $body .= $this->encodeString($this->Body, $this->Encoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->endBoundary($this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[1]);                
                break;
            case 'alt_attach':
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], '', 'text/plain', '');
                $body .= $this->encodeString($this->AltBody, $this->Encoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->getBoundary($this->boundary[2], '', 'text/html', '');
                $body .= $this->encodeString($this->Body, $this->Encoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->endBoundary($this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'alt_inline_attach':
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->textLine('--' . $this->boundary[2]);
                $body .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[3] . '"');
                $body .= $this->LE;                
                $body .= $this->getBoundary($this->boundary[3], '', 'text/plain', '');
                $body .= $this->encodeString($this->AltBody, $this->Encoding);
                $body .= $this->LE . $this->LE;                                                
                $body .= $this->getBoundary($this->boundary[3], '', 'text/html', '');
                $body .= $this->encodeString($this->Body, $this->Encoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->endBoundary($this->boundary[3]);
                $body .= $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[2]);                
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            default:
                // catch case 'plain' and case ''
                $body .= $this->encodeString($this->Body, $this->Encoding);
                break;
        }

        if ($this->isError()) {
            $body = '';
        } elseif ($this->sign_key_file) {
            try {
                if (!defined('PKCS7_TEXT')) {
                    throw new phpmailerException($this->lang('signing') . ' OpenSSL extension missing.');
                }
                //TODO would be nice to use php://temp streams here, but need to wrap for PHP < 5.1
                $file = tempnam(sys_get_temp_dir(), 'mail');
                file_put_contents($file, $body); //TODO check this worked
                $signed = tempnam(sys_get_temp_dir(), 'signed');
                if (@openssl_pkcs7_sign(
                    $file,
                    $signed,
                    'file://' . realpath($this->sign_cert_file),
                    array('file://' . realpath($this->sign_key_file), $this->sign_key_pass),
                    null
                )
                ) {
                    @unlink($file);
                    $body = file_get_contents($signed);
                    @unlink($signed);
                } else {
                    @unlink($file);
                    @unlink($signed);
                    throw new phpmailerException($this->lang('signing') . openssl_error_string());
                }
            } catch (phpmailerException $e) {
                $body = '';
                if ($this->exceptions) {
                    throw $e;
                }
            }
        }
        return $body;
    }             
  }
?>