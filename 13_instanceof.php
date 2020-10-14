<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="MOOC POO - PHP OpenClassrooms">
        <meta name="keywords" content="POO, PHP, Bootstrap">
        <meta name="author" content="Ramouz">
            
        <title>PHP POO</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if yor view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Content section
        ================================================== -->
        <div class="container">
            <section class="row">
                  <h1 class="text-center">POO - PHP Examples</h1>
              
                <!-- operator instanceof
                ================================================== -->
                <h2>Presentation of the operator</h2>
                <p class="col-sm-12">
                <?php
                    class A
                    {

                    }

                    class B
                    {

                    }

                    $monObjand = new A;

                    if ($monObjand instanceof A) // If $monObjand is an instance of A
                    { 
                        echo '$monObjand is an instance of A<br>';
                    }
                    else
                    {
                        echo '$monObjand isnt an instance of A<br>';
                    }

                    if ($monObjand instanceof B) // If $monObjand is an instance of B
                    {
                        echo '$monObjand is an instance of B<br>';
                    }
                    else
                    {
                        echo '$monObjand isnt an instance of B<br>';
                    }
                    ?>
                </p>
                
                <p class="col-sm-12">
                <?php
                    class D
                    {
                        
                    }

                    class E
                    {
                        
                    }

                    $monObjand = new D;

                    $classeD = 'D';
                    $classeE = 'E';

                    if ($monObjand instanceof $classeD) {
                        echo '$monObjand is an instance  ' . $classeD . '<br>';
                    } else {
                        echo '$monObjand isnt an instance  ' . $classeD . '<br>';
                    }

                    if ($monObjand instanceof $classeE) {
                        echo '$monObjand is an instance  ' . $classeE . '<br>';
                    } else {
                        echo '$monObjand isnt an instance  ' . $classeE . '<br>';
                    }
                ?>
                </p>
                
                <p class="col-sm-12">
                <?php
                    class F
                    {
                        
                    }
                    class G
                    {
                        
                    }

                    $f  = new F;
                    $f2 = new F;
                    $h  = new G;

                    if ($f instanceof $f2)
                    {
                        echo '$f and $f2 are instances of the same class<br>';
                    }
                    else
                    {
                        echo '$f and $2 are not instances of the same class<br>';
                    }

                    if ($f instanceof $h)
                    {
                        echo '$f and $g are instances of the same class<br>';
                    }
                    else
                    {
                        echo '$f and $g are not instances of the same class<br>';
                    }
                ?>
                </p>
                
                <h2>instanceof and inheritance</h2>
                <p class="col-sm-12">
                <?php
                    class I { }
                    class J extends I { }
                    class K extends J { }

                    $j = new J;

                    if ($j instanceof I)
                    {
                        echo '$j is an instance of I or $j instantiate a class that is a child of I<br>';
                    }
                    else
                    {
                        echo '$j isnt an instance of I and $j instantiate a class that isnt a child of I<br>';
                    }

                    if ($j instanceof K)
                    {
                        echo '$j is an instance of K or $j instantiate a class that isnt a child of  K<br>';
                    }
                    else
                    {
                        echo '$j  isnt an instance ofK and $j instantiate a class that isnt a child of K<br>';
                    }
                ?>
                </p>
                
                <h2>instanceof and the interfaces</h2>
                <p class="col-sm-12">
                <?php
                    interface iM { }
                    class M implements iM { }
                    class N { }

                    $m = new M;
                    $n = new N;

                    if ($m instanceof iM)
                    {
                        echo 'If iM is a class, then  $m is an instance of iM or  $m instantiate a class that is a child of iM. Else, $m instantiates a class that implements iM.<br>';
                    }
                    else
                    {
                        echo 'If iM is a class, then  $m isnt an instance of iM and $m instantiate a class that isnt a child of iM. Else, $m instantiates a class that doesnt mplements iM.<br>';
                    }

                    if ($n instanceof iM)
                    {
                        echo 'If iM is a class, then  $n is an instance of iM or $n instantiate a class that is a child of iM. Else, $n instantiates a class that implements iM.<br>';
                    }
                    else
                    {
                        echo 'If iM is a class, then  $n isnt an instance of iM and $n instantiate a class that isnt a child of iM. Else, $n instantiates a class that doesnt mplements iM.<br>';
                    }
                ?>
                </p>
                
                <p class="col-sm-12">
                    <?php
                        interface iParent { }
                        interface iFille extends iParent { }
                        class P implements iFille { }

                        $p = new P;

                        if ($p instanceof iParent)
                        {
                          echo 'If iParent is a class, then  $p is an instance of iParent or $p instantiate a class that is a child of iParent. Else, $p instantiates a class that implements iParent Or a child of  iParent.<br>';
                        }
                        else
                        {
                          echo 'If iParent is a class, then  $p isnt an instance of iParent and $p instantiate a class that isnt a child of iParent. Else, $p instantiates a class that doesnt implements   iParent nor any other child.<br>';
                        }
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>