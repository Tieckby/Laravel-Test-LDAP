<?php

namespace App\Http\Controllers;

use App\Ldap\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use LdapRecord\Models\OpenLDAP\OrganizationalUnit;

class LdapTestController extends Controller
{
    ///Test Windows Authentication with AD
    public function test_windows_auth()
    {
        $isLogged = Auth::check();

        if ($isLogged && isset($_SERVER['AUTH_USER'])) {
            $windowsUsername = $_SERVER['AUTH_USER'];
            $username = substr($windowsUsername, strpos($windowsUsername, "\\")+1);
            $currentUser = Auth::user();
            $currentUserUsingWhereClause = User::where('samaccountname', '=', $username)->first();

            return response()->json([
                'isLogged' => $isLogged,
                'welcome' => "Welcome $username",
                'currentUser' => $currentUser,
                'currentUserUsingWhereClause' => $currentUserUsingWhereClause,
            ], 200);
        }

        return response()->json([
            'error' => "Error...",
            'isLogged' => $isLogged
        ], 401);
    }

    ///Test (Username & Password) Authentication with AD
    public function login(Request $request) {
        $username = $request->username;
        $credentials = [
            'UserPrincipalName' => $username.'@test.1simple1',
            'password' => $request->password,
        ];

        $isLogged = Auth::attempt($credentials);

        if ($isLogged){
            $currentUser = Auth::user();
            $currentUserUsingWhereClause = User::where('samaccountname', '=', $username)->first();

            return response()->json([
                'isLogged' => $isLogged,
                'welcome' => "Welcome $username",
                'currentUser' => $currentUser,
                'currentUserUsingWhereClause' => $currentUserUsingWhereClause,
            ], 200);
        }
        else {
            return response()->json([
                'error' => "Error...",
                'isLogged' => $isLogged
            ], 401);
        }
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
