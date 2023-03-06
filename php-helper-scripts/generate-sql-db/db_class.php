<?php 
/* Singleton PDO Connexion Wrapper */

class DB {
    private static $link = null ;

    private static function getLink ( ) {
        if ( self :: $link ) {
            return self :: $link ;
        }

        $ini = "config.ini" ;
        $parse = parse_ini_file ( $ini , true ) ;

        $driver = $parse [ "db_driver" ] ;
        $dsn = "{$driver}:" ;
        $user = $parse [ "db_user" ] ;
        $password = $parse [ "db_password" ] ;
        $options = $parse [ "db_options" ] ;
        $attributes = $parse [ "db_attributes" ] ;

        foreach ( $parse [ "dsn" ] as $k => $v ) {
            $dsn .= "{$k}={$v};" ;
        }

        self :: $link = new PDO ( $dsn, $user, $password, $options ) ;

        foreach ( $attributes as $k => $v ) {
            self :: $link -> setAttribute ( constant ( "PDO::{$k}" )
                , constant ( "PDO::{$v}" ) ) ;
        }

        return self :: $link ;
    }

    public static function __callStatic ( $name, $args ) {
        $callback = array ( self :: getLink ( ), $name ) ;
        return call_user_func_array ( $callback , $args ) ;
    }

    public static function fetchAll( $sql, $params = null )
    {
        $stmt = DB::prepare( $sql ) ;
        if ( is_array( $params ))
        {
            foreach ( $params as $key => $val )
                $stmt->bindValue( $key, $val); // PARAM_STR par defaut, PDO::PARAM_INT);
        }
        $stmt->execute();
        $ret = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor() ;
        return $ret;
    }

    public static function fetchRow( $sql, $params = null )
    {
        $stmt = DB::prepare( $sql ) ;
        
        if ( is_array( $params ))
        {
            foreach ( $params as $key => $val )
                $stmt->bindValue( $key, $val); // PARAM_STR par defaut, PDO::PARAM_INT);
        }

        $stmt->execute();

        $ret = $stmt->fetch(\PDO::FETCH_ASSOC);
        $stmt->closeCursor() ;
        return $ret;
    }

    public static function execute( $sql, $params = null )
    {
        $stmt = DB::prepare( $sql );

        if ( is_array( $params ))
        {
            foreach ( $params as $key => $val )
                $stmt->bindValue( $key, $val); // PARAM_STR par defaut, PDO::PARAM_INT);
        }

        return $stmt->execute();
    }

    public static function useDatabase( $db_name )
    {
        $stmt = DB::prepare( "USE `{$db_name}`" ) ;
        return $stmt->execute();
    }

    /*
    $stmt->bindParam(":file_name", $files->name, PDO::PARAM_STR);

    final public function bindValues(array $inputParams) {
        foreach ($this->inputParams = array_values($inputParams) as $i => $value) {
            $varType = is_null($value) ? \PDO::PARAM_NULL : is_bool($value) ? \PDO::PARAM_BOOL : is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR;

            if (!$this->bindValue(++ $i, $value, $varType))
                return false;
        }

        return true;
    }
    */
}

