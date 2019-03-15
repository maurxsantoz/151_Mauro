<?php
/**
 * Author   : nicolas.glassey@cpnv.ch
 * Project  : 151_2019_ForStudents
 * Created  : 05.02.2019 - 18:40
 *
 * Last update :    [01.12.2018 author]
 *                  [add $logName in function setFullPath]
 * Git source  :    [link]
 */

function sendHome(){
    require "view/home.php";
}
function login($loginRequest)
{
    if(isset($loginRequest["inputUserEmailAddress"]) && isset($loginRequest["inputUserPassword"]))
    {
        $userEmail = $loginRequest["inputUserEmailAddress"];

        $userPassword = $loginRequest["inputUserPassword"];

        require "model/userManagement.php";
        if (isLoginCorrect($userEmail, $userPassword))
        {
            $_SESSION["userEmail"] = $userEmail;
            require "view/home.php";
        }
        else
        {
            $_GET["erreur"] = "Error logging";
            require "view/loginView.php";
        }

    }
    else
    {
        $_GET["action"] = "login";
        require "view/loginView.php";
    }
}
function logout(){
    // destroy the session
    $_SESSION=array();
    session_destroy();
    sendHome();
}
function fillSnows(){
    require "model/userManagement.php";
    $snowList="";
    $tableau=getSnows();
    foreach($tableau as $snow){
        $snowList=$snowList . "<tr>";
        foreach($snow as $data){
            $snowList="<th>".$data ."</th>";
        }
        $snowList=$snowList . "</tr>";
    }
    require "view/snows.php";

}
function register($registerRequest){
    if(isset($registerRequest["inputUserEmailAddress"]) && isset($registerRequest["inputUserPassword1"])&&isset($registerRequest["inputUserPassword2"])) {
        if ($registerRequest["inputUserPassword1"] == $registerRequest["inputUserPassword2"]) {
            $userEmail = $registerRequest["inputUserEmailAddress"];

            $userPassword = $registerRequest["inputUserPassword1"];

            require "model/userManagement.php";
            if (isRegisterCorrect($userEmail, $userPassword)) {
                $_SESSION["userEmail"] = $userEmail;
                require "view/home.php";
            } else {
                $_GET["error"] = "Error logging";
                require "view/register.php";
            }
        } else {
            require "view/register.php";
        }
    }
}
?>