
<?php
class UserService {

    public function getUserData($userId) {
        // Check if the user has permission to access this data
        Auth::Check($_SESSION['token']);

        $user = User::find($userId);

        if ($user->role !== 'admin') {
            throw new Exception("You do not have permission to access this resource.");
        }

        return $user;
    }
}
?>
