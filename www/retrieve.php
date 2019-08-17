<?php

function route($method, $id)
{
    if ($method === 'GET' && isset($id))
    {
        if (!preg_match('/^[0-9]+$/', $id))
        {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode( array('error' => 'Incorrect ID') );
            return;
        }

        $db = DataBase::DB_connect(HOST, DB_NAME, 'utf8', USER, PSSW);

        $sql = "SELECT * FROM `val`
                WHERE id = ?";
        $result = $db->select($sql, array($id));
        if (!$result)
        {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode( array('error' => 'Non-existent ID') );
            return;
        }
        
        echo json_encode(array(
            'method' => 'GET',
            'id' => $id,
            'value' => $result['value'],
        ));

        return;
    }

    header('HTTP/1.0 400 Bad Request');
    echo json_encode( array('error' => 'Bad Request') );
}