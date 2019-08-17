<?php

function random_val($length, $characters)
{
	$strlength = strlen($characters);
	$random = '';
	
    for ($i = 0; $i < $length; $i++)
		$random .= $characters[rand(0, $strlength - 1)];
    
	return $random;
}

function route($method, $args)
{
    if ($method === 'POST')
    {
        $types = array('alphanumeric', 'number', 'string');
        $type = $args['type'] ?? $types[rand(0, count($types) - 1)];

        $length = $args['length'] ?? rand(1, 45);
        if (!preg_match('/^[0-9]{1,45}$/', $length))
        {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode( array('error' => 'Incorrect Length') );
            return;
        }

        switch ($type)
        {
            case 'alphanumeric': $value = random_val($length, "0123456789abcdefghij");
                                 break;
            case 'number':       $value = random_val($length, "0123456789");
                                 break;
            case 'string':       $value = random_val($length, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
                                 break;
            default:             header('HTTP/1.0 400 Bad Request');
                                 echo json_encode( array('error' => 'Unknown Type') );
                                 return;
        }
        
        $db = DataBase::DB_connect(HOST, DB_NAME, 'utf8', USER, PSSW);

        $sql = "INSERT INTO `val` VALUES
                (NULL, ?, ?, ?);";
        
        echo json_encode(array(
            'method' => 'POST',
            'id' => $db->insert($sql, array($value, $type, $length)),
            'value' => $value,
            'formData' => $args
        ));

        return;
    }

    header('HTTP/1.0 400 Bad Request');
    echo json_encode( array('error' => 'Bad Request') );
}