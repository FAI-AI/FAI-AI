<?php
/**
 * Connect to the database
 * @return PDO
 */
require BASE_PATH . '/core/Model.php';

class UserModel extends Model
{
    function __construct($table = 'user')
    {
        $this->table = $table;
    }
    // Get all users
    public function getAll()
    {
        $conn     = $this->connectDB();             // Connect to the database
        $result   = null;
        // Check if the connection is successful
        if ($conn) {
            $sql      = "SELECT * FROM ".$this->table." ORDER BY id ASC";
            $resource = $conn->query($sql);
            if ($resource) {                        // Check if the query is successful
                $result = $resource->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        return $result;                             // Return the result
    }
    // Get user by ID
    public function getByID($id)
    {
        $conn   = $this->connectDB();            // Connect to the database
        $result = array();
        // Check if the connection is successful
        if ($conn)
        {
            $sql        = "SELECT * FROM ".$this->table." WHERE id = ".$id;
            $resource   = $conn->query($sql);
            $result     = $resource->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result ? $result[0] : array();         //return the result
    }
    // Insert/ Create a new user
    public function insert($data = array())
    {
        $conn   = $this->connectDB();               // Connect to the database
        $result = false;
        // Check if the connection is successful
        if ($conn)
        {
            $sql = "INSERT INTO {$this->table} (first_name, last_name, email)
                    VALUES (?,?,?)";

            $result = $conn->prepare($sql)->execute([
              $data['first_name'], $data['last_name'], $data['email']
            ]);
        }
        return $result;                 // return the result
    }
    //update user data
    public function update($data)
    {
        $result = false;
        $conn   = $this->connectDB();
        // Check if the connection is successful
        if ($conn) {
            $sql = "UPDATE {$this->table}
                    SET first_name=?, last_name=?, email=?
                    WHERE id=?";
            $result = $conn->prepare($sql)->execute([
                $data['first_name'], $data['last_name'], $data['email'], $data['id']
            ]);
        }

        return $result;                       // return the result
    }
    // Delete user
    public function delete($id)
    {
        $conn   = $this->connectDB();
        $result = false;
        // Check if the connection is successful
        if ($conn) {
            $sql = "DELETE FROM {$this->table} WHERE id=?";
            $result = $conn->prepare($sql)->execute([$id]);
        }
        return $result;              // return the result
    }
}
