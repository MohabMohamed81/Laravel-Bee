<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Profile Page</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body> 

        <?php 
            
            if(!session()->has('Mohab')){
                echo response()->json(['error'=> 'Unauthorised'],401);
            }else {
                $userInfo = session('Mohab');
                foreach($userInfo as $val){
                    echo"User Id: ". $val->id."<br>";
                    echo "User Name: ".$val->name."<br>";
                    echo "User Email: ".$val->email;
                } ?>

                <div>
                    <a href="/logoutme">Logout</a>
                </div>
            <?php       
            
            }

        ?>

        

    </body>
</html>
