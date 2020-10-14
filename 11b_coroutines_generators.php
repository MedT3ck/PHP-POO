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
        <!-- Section Contenu
        ================================================== -->
        <div class="container">
            <section class="row">
               <h1 class="text-center">POO - PHP Examples</h1>

               <!-- The generators - The coroutines
                      Or inverse generators
                      to take values and not return
                ================================================== -->
                <h2>The method send()</h2>
                <p><strong>send data to the generator</strong></p>
                <p class="col-sm-12">
                    <?php

                    function generator() {
                        echo yield;
                    }

                    $generator = generator();
                    $generator->send('<p>Hello world from the variable <code>$generator</code>!!!</p>');

                    function generator2() {
                        echo (yield 'Hello world !');
                        echo yield;
                        // echo yield; // To test message display 3
                    }

                    $generator2 = generator2();

                    // Sending « Message 1 »
                    // PHP will display it due to the first generator echo
                    $generator2->send('<p>Message 1</p>');

                    // Sending « Message 2 »
                    // PHP resumes the execution of the generator and displays the message due to the 2nd echo
                    $generator2->send('<p>Message 2</p>');

                    // Sending « Message 3 »
                    // The generator function was already complete, so nothing happens
                    $generator2->send('<p>Message 3</p>');
                    ?>
                </p>


                <h2>A multitasking Example</h2>
                <p><strong>send data to the generator</strong></p>
                <p class="col-sm-12">
                <?php

                class TaskRunner {

                    protected $tasks;

                    public function __construct() {
                        // We initialize the list of tasks
                        $this->tasks = new SplQueue;
                    }

                    public function addTask(Generator $task) {
                        // Add the task at the end of the list
                        $this->tasks->enqueue($task);
                    }

                    public function run() {
                        // As long as there is always at least one task to perform
                        while (!$this->tasks->isEmpty()) {
                            // We remove the first task and we recover it in passing
                            $task = $this->tasks->dequeue();

                            // We perform the next step of the task
                            $task->send('Hello world !');

                            // Si la Task n’est pas finie, on la replace en fin de liste
                            if ($task->valid()) {
                                $this->addTask($task);
                            }
                        }
                    }

                }
                
                
                // Test the class
                $taskRunner = new TaskRunner;

                function task1() {
                    for ($i = 1; $i <= 2; $i++) {
                        $data = yield;
                        echo '<p>Task 1, iteration ' . $i . ', value sent : ' . $data . '</p>';
                    }
                }

                function task2() {
                    for ($i = 1; $i <= 6; $i++) {
                        $data = yield;
                        echo '<p>Task 2, iteration ' . $i . ', value sent : ' . $data . '</p>';
                    }
                }

                function task3() {
                    for ($i = 1; $i <= 4; $i++) {
                        $data = yield;
                        echo '<p>Task 3, iteration ' . $i . ', value sent : ' . $data . '</p>';
                    }
                }

                $taskRunner->addTask(task1());
                $taskRunner->addTask(task2());
                $taskRunner->addTask(task3());

                $taskRunner->run();
                ?>  
                </p>
                
                
                <h2>The method throw()</h2>
                <p><strong>Throw an exception to the location of<code>yield</code> in the generator - accepts a single argument</strong></p>
                <p class="col-sm-12">
                <?php
                // Generate a fatal error - normal - an exception is thrown by PHP
//                function generator3() {
//                    echo "<p>Start</p>";
//                    yield;
//                    echo "<p>End</p>";
//                }
//
//                $generator3 = generator3();
//                $generator3->throw(new Exception('<p>Test</p>'));
                
                
                
                function generator4() {
                    // We make a loop of 5 yield to keep something simple
                    for ($i = 0; $i < 5; ++$i) {
                        // We indicate that we have just entered the iteration
                        echo "<p>Start $i</p>";

                        // We try to "catch" the value we were given
                        try {
                            yield;
                        } catch (Exception $e) {
                            // If an exception has been thrown, its number is indicated
                            echo "<p>Exception $i</p>";
                        }

                        // Finally, we indicate that we have just finished the iteration iteration
                        echo "<p>End $i</p>";
                    }
                }

                $generator4 = generator4();

                foreach ($generator4 as $i => $val) {
                    // We decide to throw an exception for iteration n°3
                    if ($i == 3) {
                        $generator4->throw(new Exception('<p>Petit test</p>'));
                    }
                }
                ?>
                </p>
                
                
                <h2>MultiTask w/ throw</h2>
                <p class="col-sm-12">
                <?php
                class TaskRunner2 {

                    protected $tasks;

                    public function __construct() {
                        // We initialize the list of Tasks
                        $this->tasks = new SplQueue;
                    }

                    public function addTask(Generator $task) {
                        // We add the Task at the end of the list
                        $this->tasks->enqueue($task);
                    }

                    public function run() {
                        $i = 1;

                        // As long as there is always at least one Task to perform
                        while (!$this->tasks->isEmpty()) {
                            // We remove the first Task and we recover it in passing
                            $task = $this->tasks->dequeue();

                            // For the example, we will stop the Task n ° 2 during its 2nd call
                            if ($i == 5) {
                                $task->throw(new Exception('Task interrompue'));
                            }

                            // We execute the next stage of the Task
                            $task->send('Hello world !');

                            // If the Task is not finished, we replace it at the end of the list
                            if ($task->valid()) {
                                $this->addTask($task);
                            }

                            $i++;
                        }
                    }

                }

                $taskRunner2 = new TaskRunner2;

                function task1a() {
                    for ($i = 1; $i <= 2; $i++) {
                        try {
                            $data = yield;
                            echo '<p>Task 1, iteration ' . $i . ', value sent : ' . $data . '</p>';
                        } catch (Exception $e) {
                            echo '<p>Erreur Task 1 : ' . $e->getMessage() . '</p>';
                            return;
                        }
                    }
                }

                function task2a() {
                    for ($i = 1; $i <= 6; $i++) {
                        try {
                            $data = yield;
                            echo '<p>Task 2, iteration ' . $i . ', value sent : ' . $data . '</p>';
                        } catch (Exception $e) {
                            echo '<p>Erreur Task 2 : ' . $e->getMessage() . '</p>';
                            return;
                        }
                    }
                }

                function task3a() {
                    for ($i = 1; $i <= 4; $i++) {
                        try {
                            $data = yield;
                            echo '<p>Task 3, iteration ' . $i . ', value sent : ' . $data . '</p>';
                        } catch (Exception $e) {
                            echo '<p>Erreur Task 3 : ' . $e->getMessage() . '</p>';
                            return;
                        }
                    }
                }

                $taskRunner2->addTask(task1a());
                $taskRunner2->addTask(task2a());
                $taskRunner2->addTask(task3a());

                $taskRunner2->run();
                ?>
                </p>
            </section>
        </div>
    </body>
</html>