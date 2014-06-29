<?php


class User {
    function isAuthenticated() {
        return true;
    }
}

interface PluginTestInterface {

}

class AuthenticatedStatus implements PluginTestInterface {

}
class UnauthenticatedStatus implements PluginTestInterface {

}


class TestProviderPlugin extends \Auryn\Plugin\StandardProviderPlugin {

    private $user;

    function __construct(User $user) {
        $this->user = $user;
    }

//    function isAliased($typeHintLower, array $classConstructorChain) {
//        if ($typeHintLower == strtolower('AuthenticationStatus')) {
//            return true;
//        }
//        return parent::isAliased($typeHintLower, $classConstructorChain);
//    }

    function resolveAlias($className, array $classConstructorChain) {
        $typeHintLower = strtolower($className);
        if ($typeHintLower == strtolower('AuthenticationStatus')) {
            if ($this->user->isAuthenticated() == true) {
                return array('AuthenticatedStatus', $this->normalizeClassName('AuthenticatedStatus'));
            }
            else {
                return array('UnauthenticatedStatus', $this->normalizeClassName('UnauthenticatedStatus'));
            }
        }

        return parent::resolveAlias($className, $classConstructorChain);
    }
}


class WidgetWithParams {

    public $name = null;

    function __construct($name){
        $this->name = $name;
    }
}

class UsesWidgetWithParams1{

    public $widget;

    public function __construct(WidgetWithParams $widget) {
        $this->widget = $widget;
    }
}

class UsesWidgetWithParams2 {
    public $widget;

    public function __construct(WidgetWithParams $widget) {
        $this->widget = $widget;
    }
}

class UsesWidget {

    public $widget;

    public function __construct(WidgetWithParams $widget) {
        $this->widget = $widget;
    }
}

class UsesWidgetWithParamsOnceRemoved1 {

    public $usesWidget;

    function __construct(UsesWidget $usesWidget) {
        $this->usesWidget = $usesWidget;
    }
}

class UsesWidgetWithParamsOnceRemoved2 {

    public $usesWidget;

    function __construct(UsesWidget $usesWidget) {
        $this->usesWidget = $usesWidget;
    }
}


class LoggerTest {

    private $logLevel;

    function __construct($logLevel) {
        $this->logLevel = $logLevel;
    }

    function getLogLevel(){
        return $this->logLevel;
    }

    public function info($message, array $context = array()){}
    public function warning($message, array $context = array()){}
}

class RequiresLoggerDependency1{

    public $logger;

    function __construct(LoggerTest $logger){
        $this->logger = $logger;
    }
}

class RequiresLogger1{

    public $requiresLoggerDependency1;
    public $logger;

    public function __construct(LoggerTest $logger, RequiresLoggerDependency1 $requiresLoggerDependency1){
        $this->requiresLoggerDependency1 = $requiresLoggerDependency1;
        $this->logger = $logger;
    }
}


class RequiresLoggerDependency2{

    public $logger;

    function __construct(LoggerTest $logger){
        $this->logger = $logger;
    }
}

class RequiresLogger2{

    public $requiresLoggerDependency2;
    public $logger;

    public function __construct(LoggerTest $logger, RequiresLoggerDependency2 $requiresLoggerDependency2){
        $this->requiresLoggerDependency2 = $requiresLoggerDependency2;
        $this->logger = $logger;
    }
}

class DependencyClass {}

class DependencyClassHasDefault {
    public $dependencyClass;
    function __construct(DependencyClass $dependencyClass = null) {
        $this->dependencyClass = $dependencyClass;
    }
}


interface DependencyInterface {}

class DependencyInterfaceHasDefault {
    public $dependencyInterface;
    function __construct(DependencyInterface $dependencyInterface = null) {
        $this->dependencyInterface = $dependencyInterface;
    }
}
