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

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
                <!-- Exceptions
                ================================================== -->
                <h2>The principle - traits</h2>
                <p class="col-sm-12">
                    <strong><em>The line allows the use of the code of a method in several independent classes. Remember, a child class can inherit only one parent class. The feature allows to "extend" the inheritance principle.</em></strong><br>
                    <?php
                    // Example 1
                    trait MyHTMLFormater
                    {
                        public function format($text)
                        {
                            return '<p>Date : ' . date('d/m/Y') . '</p>' . "\n" .
                                   '<p>' . nl2br($text) . '</p>';
                        }
                    }
                    
                    trait MyTextFormater
                    {
                        public function format($text)
                        {
                            return 'Date : ' . date('d/m/Y') . "\n" . $text;
                        }
                    }
                    
                    trait AfficheSimpleText
                    {
                        protected $string = 'Bonjour !<br>';
                        
                        public function showString()
                        {
                            echo $this->string;
                        }
                    }
                    
                    trait ToIncludeInOther
                    {
                        public function SayToIncludeInOther()
                        {
                            echo 'I am a basic trait to include in another trait.<br>';
                        }
                    }
                    
                    trait UseAnOtherTrait
                    {
                        use ToIncludeInOther;
                        
                        public function SaySomethingToo()
                        {
                            echo 'I am the trait UseAnOtherTrait.<br>';
                        }
                    }
                    
                    class My_Writer
                    {
                        use MyHTMLFormater, MyTextFormater
                        {
                            MyHTMLFormater::format insteadof MyTextFormater;
                        }
                        
                        public function write($text)
                        {
                            file_put_contents('txt/fichier.txt', $this->format($text));
                        }
                    }
                    
                    class My_Mailer
                    {
                        use MyHTMLFormater;
                        
                        public function send($text)
                        {
                            mail('ElRamouz@gmail.com', 'Test Traits', $this->format($text));
                        }
                    }
                    
                    class Affiche_Text
                    {
                        use AfficheSimpleText;
                    }
                    
                    class UseTraitInTrait
                    {
                        use UseAnOtherTrait;
                    }
                    
                    $objWriter = new My_Writer;
                    $objWriter->write('Hello world!');
                    
                    $objMailer = new My_Mailer;
                    $objMailer->send('Hello world!');
                    
                    $objAfficheText = new Affiche_Text();
                    $objAfficheText->showString();
                    
                    $objTraitInTrait = new UseTraitInTrait;
                    $objTraitInTrait->SayToIncludeInOther();
                    $objTraitInTrait->SaySomethingToo();
                    
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>