<?php


namespace Justlzz\Solutions\Php\Base\ToolFunction\Notice;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Justlzz\Solutions\Config\ConfigInterface;

/**
 * 依赖于php Email实现
 * Class Email
 * @package Justlzz\Solutions\Php\Base\ToolFunction
 */
class Email implements NoticeInterface
{
    public $email;

    public function __construct(ConfigInterface $config)
    {
        $config = $config->toArray();
        $this->email = new PHPMailer();
        if ($config['isSMTP']) $this->email->isSMTP();// 使用SMTP服务
        $this->email->CharSet = $config['chartSet'];// 编码格式为utf8，不设置编码的话，中文会出现乱码
        $this->email->Host = $config['host'];// 发送方的SMTP服务器地址
        if ($config['SMTPAuth']) $this->email->SMTPAuth = true;// 是否使用身份验证
        $this->email->Username = $config['username'];// 发送方的QQ邮箱用户名，就是自己的邮箱名
        $this->email->Password = $config['password'];// 发送方的邮箱密码，不是登录密码,是qq的第三方授权登录码,要自己去开启,在邮箱的设置->账户->POP3/IMAP/SMTP/Exchange/CardDAV/CalDAV服务 里面
        $this->email->SMTPSecure = $config['SMTPSecure'];// 使用ssl协议方式,
        $this->email->Port = $config['port'];// QQ邮箱的ssl协议方式端口号是465/587
        //$mail->addCC("xxx@163.com");// 设置邮件抄送人，可以只写地址，上述的设置也可以只写地址(这个人也能收到邮件)
        //$mail->addBCC("xxx@163.com");// 设置秘密抄送人(这个人也能收到邮件)
        //$mail->addAttachment("bug0.jpg");// 添加附件
    }


    public function emailTitle($title)
    {
        $this->email->Subject = $title;// 邮件标题
        return $this;
    }

    public function emailContent($content)
    {
        $this->email->Body = $content;// 邮件正文
        return $this;
    }

    public function reply($email='',$name='')
    {
        $this->email->AddReplyTo($email, $name);// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
        return $this;
    }

    public function from($email,$name)
    {
        $this->email->SetFrom($email, $name);// 设置发件人信息，如邮件格式说明中的发件人,
        return $this;
    }

    public function to($email)
    {
        $this->email->addAddress($email);// 设置收件人信息，如邮件格式说明中的收件人
        return $this;
    }

    public function clearAll()
    {
        $this->email->clearAddresses();
        $this->email->clearAllRecipients();
    }

    public function send() : bool
    {
        try {
            if($this->email->send()){// 发送邮件
                return true;
            }else{
                return false;
            }
        } catch (Exception $exception) {
            //记录日志
            var_dump($exception);
            return false;
        }

    }


}