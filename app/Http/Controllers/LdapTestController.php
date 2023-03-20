<?php

namespace App\Http\Controllers;

use App\Ldap\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LdapRecord\Container;
use LdapRecord\Laravel\Middleware\WindowsAuthenticate;
use LdapRecord\Laravel\Testing\DirectoryEmulator;

// use LdapRecord\Models\OpenLDAP\OrganizationalUnit;

class LdapTestController extends Controller
{
    use WithFaker;

    public function test_windows_auth()
    {
        // DirectoryEmulator::setup('test1simple1');

        // $ldapUser = User::create([
        //     'cn' => $this->faker->name,
        //     'mail' => $this->faker->email,
        //     'objectguid' => $this->faker->uuid,
        //     'samaccountname' => $this->faker->userName,
        // ]);

        // Replace 'DOMAIN' with your domain from your configured LDAP
        // `base_dn`. For example, if your `base_dn` is equal to
        // 'dc=company,dc=com', then you would use 'COMPANY'.
        // $authUser = implode('\\', [
        //     'test', $ldapUser->getFirstAttribute('samaccountname')
        // ]);

        // Set the server variables for the upcoming request.
        // $this->withServerVariables([
        //     WindowsAuthenticate::$serverKey => $authUser
        // ]);

        return response()->json([
            'isLogged' => Auth::check(),
            'key' => WindowsAuthenticate::$serverKey,
            'username' => isset($_SERVER['AUTH_USER']) ? $_SERVER['AUTH_USER'] : "...",
            'serverData' => $_SERVER,
        ], 200);
    }

    public function login(Request $request) {
        $credentials = [
            'UserPrincipalName' => $request->username.'@test.1simple1',
            'password' => $request->password,
        ];

        $isLogged = Auth::attempt($credentials);

        if ($isLogged){
            $user = Auth::user();

            return response()->json([
                'user' => $user,
                'isLogged' => $isLogged,
                'findByUID' => User::where('samaccountname', '=', 'hello.test')->first(),
                'list' => User::all(),
            ], 200);
        }
        else {
            return response()->json([
                'error' => "Error...",
                'isLogged' => $isLogged
            ], 401);
        }

        // try {

        //     //Authentication Using Auth
        //     if (Auth::attempt(
        //         [
        //             'UserPrincipalName' => $request->username,
        //             'password' => $request->password
        //         ])) {

        //         return "It's OK";
        //     }

        //     return "Not OK";

        // $connection = Container::getDefaultConnection();
        //     //Authentication Using Container Connection
        //     if ($connection->auth()->attempt($request->username, $request->password))
        //     {
        //         $query = $connection->query();
        //         // $results = $query->findBy('samaccountname', 'hello.test');
        //         $results = $query->select(['cn', 'samaccountname'])->get();

        //         $user = User::where('samaccountname', '=', 'hello3.test')->first();

        //         return response()->json([
        //             'message' => "Successfully connected !",
        //             'users' => $user,
        //             'result' => mb_convert_encoding($results, 'UTF-8')
        //         ], 200);
        //     }

        //     return response()->json([
        //         'error_message' => "Username or Password Invalid !",
        //     ], 401);

        //     // echo "Successfully connected!";
        // } catch (\LdapRecord\Auth\BindException $e) {
        //     $error = $e->getDetailedError();

        //     echo $error->getErrorCode();
        //     echo $error->getErrorMessage();
        //     echo $error->getDiagnosticMessage();
        // }
    }

    /**
     *
     *
     * Some function to perform LDAP Queries
     *
     *
     */

    // // Retrieve the first model of a global LDAP search...
    // $user = User::first();

    // // Retrieve a model by its distinguished name...
    // $user = User::find('cn=John Doe,dc=local,dc=com');

    // // Retrieve the first model that matches the attribute...
    // $user = User::findBy('cn', 'John Doe');

    // // Retrieve the first model that matches an array of ANR attributes...
    // $user = User::findByAnr('John Doe');

    // // Retrieve a model by its object guid...
    // $user = User::findByGuid('bf9679e7-0de6-11d0-a285-00aa003049e2');

    // try {
    //     // Retrieve the first model of a global LDAP search or fail...
    //     $user = User::firstOrFail();

    //     // Retrieve a model by its distinguished name or fail...
    //     $user = User::findOrFail('cn=John Doe,dc=local,dc=com');

    //     // Retrieve the first model that matches the attribute or fail...
    //     $user = User::findByOrFail('cn', 'John Doe');

    //     // Retrieve the first model that matches an array of ANR attributes or fail...
    //     $user = User::findByAnrOrFail('John Doe');

    //     // Retrieve a model by its object guid or fail...
    //     $user = User::findByGuidOrFail('bf9679e7-0de6-11d0-a285-00aa003049e2');
    // } catch (\LdapRecord\Models\ModelNotFoundException $e) {
    //     // One of the models could not be located...
    // }
}
