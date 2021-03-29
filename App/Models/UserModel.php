<?php
namespace App\Models;
use App\Models\Database;
use App\Helpers\Hash;

class UserModel extends Database{

    public $data = array();
    public $key;

    // This function can be used to perform all insertion. we used this in registration
	public function create($table, $data = array())
    {
        if (count($data)) {
            $head=array_keys($data);
            $content=array_values($data);   
            $sql = "INSERT INTO $table(".implode(',',$head).") VALUES ('" . implode("', '", $content) . "' )";
            $prepare = $this->conn->prepare($sql);
            if ($prepare->execute($data)) {
                $this->data = array(
                    'firstname'=>$data['firstname'],
                    'lastname'=>$data['lastname'],
                    'email'=>$data['email'],
                );
                return true;
            }
            return false;
        }
        return false;
    }

	public function authenticate($email, $password)
	{
		$query = "SELECT id, secret_key, firstname, lastname,email, password FROM users WHERE email = ? ";
        $stmt = $this->conn->prepare($query);
        $email = htmlspecialchars(strip_tags($email));
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $num = $stmt->rowCount();
        if($num>0){
        	$row = $stmt->fetch(\PDO::FETCH_ASSOC);
        	if(Hash::check($password, $row['password'])){
        		$this->data =  $row;
                return true;
        	}
        	return false;
        }

        return false;
	}

    //Verify jwt secret key. 
    public function checkKey($id)
    {
        $query = "SELECT id, secret_key FROM users WHERE id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $num = $stmt->rowCount();
        if($num>0){
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);    
            $this->key =  $row['secret_key'];
            return $this->key;   
        }

        return false;
    }

    public function changeKey($id)
    { 
        $secret_key = Hash::secret();
        $sql = "UPDATE users SET secret_key = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1,  $secret_key);
        $stmt->bindParam(2,  $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
     
}