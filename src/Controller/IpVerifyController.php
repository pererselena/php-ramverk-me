<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpVerifyController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->ip = new \Anax\IpVerify\IpVerify();
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $title = "Ip Validering";
        $ipAddress = $this->di->session->get("ipAddress");
        if ($ipAddress) {
            if ($this->ip->ipVerify($ipAddress)) {
                $validationMsg = $this->ip->getIpInfo($ipAddress);
                $domain = $this->ip->getDomain($ipAddress);
            } else {
                $validationMsg = "$ipAddress är inte giltig ip adress";
                $domain = "n/a";
            }
            $this->di->session->set("ipAddress", null);
        } else {
            $validationMsg = "";
            $domain = "";
        }

        $page->add("ipVerify/index", [
            "validationMsg" => $validationMsg,
            "domain" => $domain,
            "title" => $title,
        ]);

        return $page->render();
    }


    /**
     * This sample method action it the handler for route:
     * POST mountpoint/create
     *
     * @return string
     */
    public function indexActionPost() : string
    {
        $ipAddress = $this->di->request->getPost("ipAddress");
        $this->di->session->set("ipAddress", $ipAddress);

        return $this->di->response->redirect("verify_ip/index");
    }
}
