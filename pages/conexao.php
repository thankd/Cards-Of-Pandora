<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conexao = "mysql.hostinger.com.br";
$database_conexao = "u657919291_copo";
$username_conexao = "u657919291_root";
$password_conexao = "thales@123";
$conexao = mysql_pconnect($hostname_conexao, $username_conexao, $password_conexao) or trigger_error(mysql_error(),E_USER_ERROR);FechaConexoes();


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