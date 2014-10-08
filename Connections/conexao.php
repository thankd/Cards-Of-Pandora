<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$conexao = mysql_connect ("localhost", "root", "usbw");
    mysql_select_db("copo",$conexao); 
    FechaConexoes();


function FechaConexoes() {
    //DELETA TODAS AS CONEXÕES ABERTAS
    $result = mysql_query("SHOW FULL PROCESSLIST");
    $conexoesAbertas = mysql_num_rows($result);
    if ($conexoesAbertas > 10) {
        while ($row=mysql_fetch_array($result)) {
        $process_id=$row["Id"];
            if ($row["Time"] > 200 ) {
                $sql="KILL $process_id";
                mysql_query($sql);
            }
        }
    }
}

?>