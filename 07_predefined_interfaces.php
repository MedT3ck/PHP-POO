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
                <!--  Iterator
                ================================================== -->
                 <h2> Iterator</h2>
                <p class="col-sm-12">
                    <strong><em>This interface makes it possible to modify the behavior of the object traversed.</em></strong><br>
                    <?php
                    // Example 1
                    class Test_Iterator implements Iterator
                    {
                        private $_positionInArray = 0;
                        private $_array = ['position 1', 'Position 2', 'Position 3', 'Position 4', 'Position 5'];
                        
                        /*
                         * Optional method
                         */
                        public function __construct() {
                            $this->_positionInArray = 0;
                        }
                        
                        /*
                         * Methods needed for the Iterator interface
                         */
                        // Retourne l'élément courant
                        public function current()
                        {
                            return $this->_array[$this->_positionInArray];
                        }
                        
                        // Returns the key of the current element
                        public function key()
                        {
                            return $this->_positionInArray;
                        }
                        
                        // Move the iterator to the next element
                        public function next()
                        {
                            ++$this->_positionInArray;
                        }
                        
                        // Put the iterator back to position 0 (first element)
                        public function rewind()
                        {
                            $this->_positionInArray = 0;
                        }
                        
                        // Check if the current position is valid
                        public function valid()
                        {
                            return isset($this->_array[$this->_positionInArray]);
                        }
                    }
                    
                    $obj = new Test_Iterator;
                    
                    foreach ($obj as $key => $value) {
                        echo $key, ' => ', $value, '<br>';
      
                    }
                    ?>
                </p>
                
                <!--  SeekableIterator
                ================================================== -->
                <h2> SeekableIterator</h2>
                <p class="col-sm-12">
                    <strong><em>This interface inherits from the interface Iterator and has an additional method (seek) which allows to reach a precise position.</em></strong><br>
                    <?php
                    // Example 2
                    class Test_SeekableIterator implements SeekableIterator
                    {
                        private $_positionInArray = 0;
                        private $_array = ['Element 1', 'Element 2', 'Element 3', 'Element 4', 'Element 5'];
                        
                        /*
                         * Optional method
                         */
                        public function __construct()
                        {
                            $this->_positionInArray = 0;
                        }
                        
                        /*
                         * Methods needed for the Iterator interface
                         */
                        public function current()
                        {
                            return $this->_array[$this->_positionInArray];
                        }
                        
                        public function key()
                        {
                            return $this->_positionInArray;
                        }
                        
                        public function next()
                        {
                            ++$this->_positionInArray;
                        }
                        
                        public function rewind()
                        {
                            $this->_positionInArray = 0;
                        }
                        
                        public function valid()
                        {
                            return isset($this->_array[$this->_positionInArray]);
                        }
                        
                        /*
                         * Required method for the SeekableIterator interface
                         */
                        public function seek($position)
                        {                        
                            if (!isset($this->_array[$position])) {
                                throw new OutOfBoundsException('Position (' . $position . ') doesnt exist');
                            }
                            
                            echo 'Current position (' . $position . ') = ';
                            $this->_positionInArray = $position;
                        }
                    }
                    
                    try {
                        $obj = new Test_SeekableIterator;
                    
//                        foreach ($obj as $key => $value) {
//                            echo $key, ' => ', $value, '<br>';
//                        }
                        
                        echo $obj->current() . '<br>';
                        
                        $obj->seek(2);
                        echo $obj->current() . '<br>';
                        
                        $obj->seek(1);
                        echo $obj->current() . '<br>';
                        
                        $obj->seek(10);
                        
                        
                    } catch (OutOfBoundsException $expression) {
                        echo $expression->getMessage();
                    }
                    ?>
                </p>
                
                <!--  ArrayAccess
                ================================================== -->
                <h2> ArrayAccess</h2>
                <p class="col-sm-12">
                    <strong><em>This interface introduces the management of hooks and keys following the object. The interface is then accessible as a real object.</em></strong><br>
                    <?php
                    // Example 3
                    class Test_ArrayAccess implements SeekableIterator, ArrayAccess
                    {
                        private $_positionInArray = 0;
                        private $_array = ['Element 1', 'Element 2', 'Element 3', 'Element 4', 'Element 5'];
                        
                        /*
                         * Optional method
                         */
                        public function __construct()
                        {
                            $this->_positionInArray = 0;
                        }
                        
                        /*
                         * Methods needed for the Iterator interface
                         * SeekableIterator inherits from Iterator
                         */
                        public function current()
                        {
                            return $this->_array[$this->_positionInArray];
                        }
                        
                        public function key()
                        {
                            return $this->_positionInArray;
                        }
                        
                        public function next()
                        {
                            ++$this->_positionInArray;
                        }
                        
                        public function rewind()
                        {
                            $this->_positionInArray = 0;
                        }
                        
                        public function valid()
                        {
                            return isset($this->_array[$this->_positionInArray]);
                        }
                        
                        /*
                         * Required method for the SeekableIterator interface
                         */
                        public function seek($position)
                        {                        
                            if (!isset($this->_array[$position])) {
                                throw new OutOfBoundsException('La position (' . $position . ') n\'existe pas');
                            }
                            
                            echo 'Position courante (' . $position . ') = ';
                            $this->_positionInArray = $position;
                        }
                        
                        /*
                         * Methods needed for the ArrayAccess interface
                         */
                        // Verification of the existence of an offset
                        public function offsetExists($offset) {
                            return isset($this->_array[$offset]);
                        }
                        
                        // Returns the value of the offset
                        public function offsetGet($offset) {
                            return $this->_array[$offset];
                        }
                        
                        // Assign a value to the specified offset
                        public function offsetSet($offset, $value) {
                            $this->_array[$offset] = $value;
                        }
                        
                        // Delete an offset
                        public function offsetUnset($offset) {
                            unset($this->_array[$offset]);
                        }
                    }
                    
                    $obj = new Test_ArrayAccess;
                    echo 'Course of the object :<br>';
                    foreach ($obj as $key => $value) {
                        echo $key . ' => ' . $value . '<br>';
                    }
                    
                    echo '<br>Positioning the cursor on the element3 :<br>';
                    $obj->seek(2);
                    echo $obj->current();
                    
                    echo '<br>';
                    
                    echo '<br>Displaying the item 4 : ' . $obj[3] . '<br>' ;
                    echo 'Modification of element 4 in progress ...<br>';
                    $obj[3] = 'Modified text of element 4';
                    echo ' New value of element 4: ' . $obj[3] . '<br>';
                    
                    echo '<br>';
                    
                    echo 'Destruction of the 5th element in progress...<br>';
                    unset($obj[4]);
                    if (isset($obj[4])) {
                        echo '$obj[4] exist';
                    } else {
                        echo '$obj[4] is destroyed ';
                    }
                    
                    ?>
                </p>
                
                <!--  Countable
                ================================================== -->
                <h2> Countable</h2>
                <p class="col-sm-12">
                    <strong><em>With this interface, the class gets closer to the behavior of an array. One method for this interface: count</em></strong><br>
                    <?php
                    // Example 3
                    class Test_Countable implements SeekableIterator, ArrayAccess, Countable
                    {
                        private $_positionInArray = 0;
                        private $_array = ['Element 1', 'Element 2', 'Element 3', 'Element 4', 'Element 5'];
                        
                        /*
                         * Optional method
                         */
                        public function __construct()
                        {
                            $this->_positionInArray = 0;
                        }
                        
                        /*
                          * Methods needed for the Iterator interface
                          * SeekableIterator inherits from Iterator
                         */
                        public function current()
                        {
                            return $this->_array[$this->_positionInArray];
                        }
                        
                        public function key()
                        {
                            return $this->_positionInArray;
                        }
                        
                        public function next()
                        {
                            ++$this->_positionInArray;
                        }
                        
                        public function rewind()
                        {
                            $this->_positionInArray = 0;
                        }
                        
                        public function valid()
                        {
                            return isset($this->_array[$this->_positionInArray]);
                        }
                        
                        /*
                         * Required method for the SeekableIterator interface
                         */
                        public function seek($position)
                        {                        
                            if (!isset($this->_array[$position])) {
                                throw new OutOfBoundsException(' Position (' . $position . ') doesnt exist');
                            }
                            
                            echo 'Position courante (' . $position . ') = ';
                            $this->_positionInArray = $position;
                        }
                        
                        /*
                         * Methods needed for the ArrayAccess interface
                         */
                        // Verification of the existence of an offset
                        public function offsetExists($offset) {
                            return isset($this->_array[$offset]);
                        }
                        
                        // Returns the value of the offset
                        public function offsetGet($offset) {
                            return $this->_array[$offset];
                        }
                        
                        // Assign a value to the specified offset
                        public function offsetSet($offset, $value) {
                            $this->_array[$offset] = $value;
                        }
                        
                        // Remove an offset
                        public function offsetUnset($offset) {
                            unset($this->_array[$offset]);
                        }
                        
                        /*
                         * Method for the Countable interface
                         */
                        public function count() {
                            return count($this->_array);
                        }
                    }
                    
                    $obj = new Test_Countable;
                    echo 'Course of the object:<br>';
                    foreach ($obj as $key => $value) {
                        echo $key . ' => ' . $value . '<br>';
                    }
                    
                    echo '<br>Positioning the cursor on element 3 :<br>';
                    $obj->seek(2);
                    echo $obj->current();
                    
                    echo '<br>';
                    
                    echo '<br>Displaying item 4 : ' . $obj[3] . '<br>' ;
                    echo 'Modification of element 4 in progress...<br>';
                    $obj[3] = 'Modified text of element 4';
                    echo 'New value of element 4: ' . $obj[3] . '<br>';
                    
                    echo '<br>';
                    
                    echo 'The table includes ' . count($obj) . ' inputs.<br>';
                    
                    echo '<br>';
                    
                    echo 'Destruction of the 5th element in progress ...<br>';
                    unset($obj[4]);
                    if (isset($obj[4])) {
                        echo '$obj[4] exists.<br>';
                    } else {
                        echo '$obj[4] is destroyed.<br>';
                    }
                    
                    echo '<br>';
                    
                    echo 'After the destruction, the table includes ' . count($obj) . ' inputs.<br>';
                    
                    ?>
                </p>
                         
            </section>
        </div>
    </body>
</html>