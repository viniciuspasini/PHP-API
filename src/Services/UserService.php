<?php

namespace Vinip\Api\Services;

use Vinip\Api\Http\JWT;
use Vinip\Api\Models\User;
use Vinip\Api\Utils\Validator;

class UserService
{
    public static function create(array $data)
    {

        try {
            $fields = Validator::validate([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            $fields['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            $user = User::save($fields);

            if(!$user) {
                throw new \Exception('we could not create user.');
            }

            return 'user created';

        }catch (\PDOException $PDOException){
            return ["error" => $PDOException->getMessage()];
        }
        catch (\Exception $e){
            return ["error" => $e->getMessage()];
        }
    }

    public static function login(array $data): array|string
    {
        try {
            $fields = Validator::validate([
                'email' => $data['email'],
                'password' => $data['password']
            ]);

            $user = User::authentication($fields);

            if(!$user) {
                throw new \Exception('we could not autehnticate.');
            }

            return JWT::generate($user);

        }catch (\PDOException $PDOException){
            return ["error" => $PDOException->getMessage()];
        }
        catch (\Exception $e){
            return ["error" => $e->getMessage()];
        }
    }

    public static function fetch(int $id, array|string $token)
    {
        try {

            if (isset($token['error'])){
                throw new \Exception($token['error']);
            }

            $userFromJWT = JWT::verify($token);

            if (!$userFromJWT){
                throw new \Exception('invalid token');
            }

            $fields = Validator::validate([
                'id' => $userFromJWT['id'],
            ]);

            $user = User::find($fields['id']);

            if(!$user) {
                throw new \Exception('user not found.');
            }

            return $user;

        }catch (\PDOException $PDOException){
            return ["error" => $PDOException->getMessage()];
        }
        catch (\Exception $e){
            return ["error" => $e->getMessage()];
        }
    }
}