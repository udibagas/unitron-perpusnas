<?php

$db = new mysqli('localhost', 'root', 'uni123', 'unique');

if (mysqli_connect_errno()) {
   echo "DB FAILED!";
   exit();
}

require_once dirname(__FILE__) . '/Phpmodbus/ModbusMaster.php';

while (True) {
    // select all listrik
    $sql = $db->query("select * from sensor where product = 'SOCOMEC'");

    while ($s = $sql->fetch_object()) {
        $modbus = new ModbusMaster($s->IPADDR, "TCP");

        try {
            $recData = $modbus->readMultipleRegisters(1, $s->VARIABELPROTOCOL, 1);
        }

        catch (Exception $e) {
            echo "MODBUS TCP FAILED!";
            exit;
        }

        $values = array_chunk($recData, 2);

        foreach ($value as $bytes) {
            $nilai = PhpType::bytes2unsignedInt($bytes);
            echo $s->PARAMETER .":" . $nilai;

            $db->query("insert into trans5 (id_sensor, tgljam, nilai, pesan, koneksi) values ($s->ID_SENSOR, now(), $nilai, '', 'Y')");

        }

    }

    sleep(5);
}
