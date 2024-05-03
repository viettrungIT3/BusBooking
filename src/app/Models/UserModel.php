<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    // List of allowable fields to update and insert
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'oauth_id',
        'profile_img',
        'created_at',
        'updated_at'
    ];

    /**
     * Check if email already exists in the database.
     *
     * @param string $email Email to check in database.
     * @return bool Returns true if email exists, false otherwise.
     */
    public function isEmailExists($email)
    {
        return $this->where('email', $email)->first() !== null;
    }

    /**
     * Check if a user is already registered with a given OAuth ID.
     *
     * @param string $authid OAuth ID to check.
     * @return bool Returns true if user exists, false otherwise.
     */
    public function isAlreadyRegister($authid) {
        return $this->where('oauth_id', $authid)->first() !== null;
    }

    /**
     * Update user data based on OAuth ID.
     *
     * @param array $userdata Array of user data to update.
     * @param string $authid OAuth ID used to identify user.
     * @return void
     */
    public function updateUserData($userdata, $authid) {
        $this->where('oauth_id', $authid)->set($userdata)->update();
    }

    /**
     * Insert new user data into the database.
     *
     * @param array $userdata Array of user data to insert.
     * @return void
     */
    public function insertUserData($userdata) {
        $this->insert($userdata);
    }
}
