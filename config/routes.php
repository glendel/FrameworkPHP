<?php

class Route {

    /**
     * Separator for dir's and files
     */
    const SEPARATOR = "/";
    
    /**
     * Return absolute Root Path
     * @return String
     */
    public static function getRootPath() {
        return dirname( dirname(  __FILE__  ) ).self::SEPARATOR;
    }
    
    /**
     * Return absolute url to App Path
     * @return String
     */
    public static function getAppPath() {
        return self::getRootPath()."app".self::SEPARATOR;
    }
    
    /**
     * Return absolute url to a Controller or Controllers Path
     * @param String $controller - name of the controller
     * @return String
     */
    public static function getControllerPath($controller = "") {
        if($controller == "") {
            return self::getAppPath()."controllers".self::SEPARATOR;
        } else {
            return self::getAppPath()."controllers".self::SEPARATOR.$controller."_controller.php";
        }
    }
    
    /**
     * Return absolute url to one View. 
     * If the param controller is empty return absolute url to the directory views.
     * If the param view is empty return absolute url to the directory views of the controller. Example views/users
     * @param String $controller - name of the controller
     * @param String $view - name of the view
     * @return String
     */
    public static function getViewPath($controller = "", $view = "") {
        if($controller == "") {
            return self::getAppPath()."views".self::SEPARATOR;
        } else if ($view == "") {
            return self::getAppPath()."views".self::SEPARATOR.$controller.self::SEPARATOR;
        } else {
            return self::getAppPath()."views".self::SEPARATOR.$controller.self::SEPARATOR.$view.".html.php";
        }
    }
    
    /**
     * Return relative url to a Model
     * @param String $model - name of the model
     * @return String
     */
    public static function getModelPath($model = "") {
        if($model == "")
            return self::getAppPath()."models".self::SEPARATOR;
        else
            return self::getAppPath()."models".self::SEPARATOR.$model.".php";
    }
    
    /**
     * Return relative url to a Helper
     * @param String $helper - name of the helper
     * @return String
     */
    public static function getHelperPath($helper = "") {
        if($helper == "")
            return self::getAppPath()."helpers".self::SEPARATOR;
        else
            return self::getAppPath()."helpers".self::SEPARATOR.$helper."_helper.php";
    }
    
    /**
     * Return absolute url to a Layout
     * @param String $layout - name of the layout
     * @return String
     */
    public static function getLayoutPath($layout = "") {
        if($layout == "")
            return self::getViewPath()."layouts".self::SEPARATOR;
        else
            return self::getViewPath()."layouts".self::SEPARATOR.$layout.".php";
    }
    
    /**
     * Return current URL
     * @param Boolean $root - if you want just the base URL
     * @return String
     **/
    public static function getCurrentUrl( $root = false ) {
      $scheme = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] == 'on' ) ? 'https://' : 'http://';
      $domain = $_SERVER[ 'SERVER_NAME' ];
      $port = ( $_SERVER[ 'SERVER_PORT' ] != '80' ) ? ( ':' . $_SERVER[ 'SERVER_PORT' ] ) : '';
      $currentUrl = $scheme . $domain . $port;
      $currentUrl .= ( ( $root === true ) ? dirname( $_SERVER[ 'SCRIPT_NAME' ] ) : $_SERVER[ 'REQUEST_URI' ] );
      
      return( $currentUrl );
    }
    
    /**
     * Return URL based on the "controller", "action" and "params"
     * @param String $controller - Controller
     * @param String $action - Action
     * @param String $params - Parameters
     * @return String
     **/
    public static function getUrlFor( $controller, $action = '', $params = '' ) {
      $url = ( self::getCurrentUrl( true ) . 'index.php' );
      
      if ( !empty( $controllers ) ) { $url .= '?controller=' . $controllers; }
      if ( !empty( $action ) ) { $url .= ( ( strpos( $url, '?' ) === false ) ? '?' : '&' ) . 'action=' . $action; }
      if ( !empty( $params ) ) { $url .= ( ( strpos( $url, '?' ) === false ) ? '?' : '&' ) . $params; }
      
      return( $url );
    }
  }
