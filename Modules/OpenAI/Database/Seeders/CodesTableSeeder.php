<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('codes')->delete();

        DB::table('codes')->insert(array (
            0 =>
            array (
                'id' => 5,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'recursion-b',
                'promt' => 'Recursion',
                'code' => 'Sure, here\'s an example of a simple recursion function in PHP:

                ```
                function countdown($num) {
                if ($num <= 0) {
                echo "Blast off!";
                } else {
                echo $num . "... ";
                countdown($num-1);
                }
                }

                countdown(5); // Output: 5... 4... 3... 2... 1... Blast off!
                ```

                This function uses recursion to countdown from a given number to 0, printing each number along the way. The function checks if the number is less than or equal to 0, and if so, it prints "Blast off!" and terminates the recursion. Otherwise, it prints the current number and calls the function again with the number decremented by 1. This continues until the number reaches 0 and "Blast off!" is printed.',
                'tokens' => 213,
                'words' => 95,
                'characters' => 671,
                'language' => 'PHP',
                'code_label' => 'Easy',
            ),
            1 =>
            array (
                'id' => 7,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'convert-an-image-into-a-string-and-compress-it-to-89-character-m',
                'promt' => 'Convert an image into a string and compress it to 8\\9 character',
                'code' => 'To convert an image into a string and compress it to 8/9 characters, we can use base64 encoding. Here\'s the PHP code:

                ```php
                // Load the image
                $image_file = \'image.jpg\';
                $image_data = file_get_contents($image_file);

                // Convert the image to a base64 string
                $base64_image = base64_encode($image_data);

                // Compress the base64 string
                $compressed_string = substr($base64_image, 0, 8);
                // or $compressed_string = substr($base64_image, 0, 9);

                // Print the compressed string
                echo $compressed_string;
                ```

                First, we read the image data from a file using `file_get_contents()` and store it in `$image_data`. Then, we convert the image data into a base64-encoded string using `base64_encode()`, and store the result in `$base64_image`.

                Next, we compress the base64 string by truncating it to the first 8 or 9 characters. This is a simple compression technique that works well for small images.

                Finally, we print the compressed string using `echo`.',
                'tokens' => 282,
                'words' => 145,
                'characters' => 943,
                'language' => 'PHP',
                'code_label' => 'Easy',
            ),
            2 =>
            array (
                'id' => 9,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'using-the-interface-abstract-write-me-a-code-which-shows-me-the-area-of-a-rectangle',
                'promt' => 'Using the interface, abstract write me a code which shows me the area of a rectangle',
                'code' => 'Here\'s an example code in Java using interfaces and abstract classes to calculate the area of a rectangle.

                ```java
                // Define the interface Shape
                interface Shape {
                public double area();
                }

                // Define the abstract class Rectangle which implements Shape
                abstract class Rectangle implements Shape {
                protected double width;
                protected double height;

                public Rectangle(double width, double height) {
                this.width = width;
                this.height = height;
                }

                // Implement the area method as abstract
                public abstract double area();
                }

                // Define a concrete class which extends Rectangle
                class RectangleArea extends Rectangle {
                public RectangleArea(double width, double height) {
                super(width, height);
                }

                // Implement the abstract method area
                public double area() {
                return width * height;
                }
                }

                // Main method to test the code
                public class Main {
                public static void main(String[] args) {
                // Create a new RectangleArea object
                RectangleArea rect = new RectangleArea(5, 10);

                // Call the area method and print the result
                System.out.println("Area of rectangle: " + rect.area());
                }
                }
                ```

                This code uses an interface `Shape` to specify the `area()` method that all shapes must implement. The `Rectangle` abstract class extends the `Shape` interface and provides a constructor and a protected `width` and `height` field. It also defines the `area()` method as an abstract method, which must be implemented by concrete classes that extend it. The `RectangleArea` class extends `Rectangle` and implements the `area()` method using the formula `width * height`. Finally, the main method creates a `RectangleArea` object with a width of 5 and height of 10, calls the `area()` method, and prints the result.',
                'tokens' => 421,
                'words' => 233,
                'characters' => 1791,
                'language' => 'Java',
                'code_label' => 'Medium',
            ),
            3 =>
            array (
                'id' => 11,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'create-a-2d-array',
                'promt' => 'Create a 2D array',
                'code' => 'Sure, here\'s an example of creating a 2D array in Java with high code level:

                ```
                int[][] myArray = new int[3][4];
                ```

                This code creates a 2D array with 3 rows and 4 columns. The `int[][]` indicates that the array contains integers, and the `new int[3][4]` statement creates a new array object with 3 rows and 4 columns.

                To assign values to the array, you can use nested loops:

                ```
                for (int i = 0; i < 3; i++) {
                for (int j = 0; j < 4; j++) {
                myArray[i][j] = i + j;
                }
                }
                ```

                This code assigns each element in the array a value equal to the sum of its row and column indices. You can also access individual elements of the array using their indices:

                ```
                int x = myArray[1][2]; // get the value at row 1, column 2
                myArray[0][3] = 5; // set the value at row 0, column 3 to 5
                ```

                I hope this example is helpful for you!',
                'tokens' => 294,
                'words' => 134,
                'characters' => 837,
                'language' => 'Java',
                'code_label' => 'Medium',
            ),
            4 =>
            array (
                'id' => 12,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'array-replace-operation',
                'promt' => 'Array replace operation',
                'code' => 'Here is the code to perform the array replace operation in Ruby with a high-level implementation:

                ```ruby
                # Define the original array
                original_array = [1, 2, 3, 4, 5]

                # Define the new array to replace the original one
                new_array = [6, 7, 8, 9, 10]

                # Perform the replace operation using the map method
                replaced_array = original_array.map.with_index { |value, index| new_array[index] ? new_array[index] : value }

                # Print the replaced array
                puts replaced_array.inspect
                ```

                In the above code, we create an original array with some values. We also define a new array that we want to use to replace the original one. Then, we perform the replace operation using the map method and a block that checks whether the new array has a value at the corresponding index or not. If it has a value, the map method uses it to replace the original value at that index; otherwise, it uses the original value. Finally, we print the replaced array using the inspect method.',
                'tokens' => 263,
                'words' => 156,
                'characters' => 956,
                'language' => 'Rubby',
                'code_label' => 'High',
            ),
            5 =>
            array (
                'id' => 13,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'node-insert-delete-update-dynamically-handle',
                'promt' => 'Node insert, delete, update dynamically handle',
                'code' => 'Here is an example of a Node class in Ruby that includes methods for inserting, deleting, and updating nodes in a dynamic tree structure:

                ```ruby
                class Node
                attr_accessor :value, :children

                def initialize(value)
                @value = value
                @children = []
                end

                def insert(node)
                @children << node
                end

                def delete(node)
                @children.delete(node)
                end

                def update(value)
                @value = value
                end
                end
                ```

                This code represents a node in a tree, where each `Node` instance has a `value` attribute and an array of child nodes stored in `children`. The `insert` method adds a child node to the current node, while the `delete` method removes a child node. The `update` method changes the value of the current node.

                These methods can be called dynamically to handle changes in the tree structure at runtime, making it easy to modify the tree structure based on application logic or user actions. The code level is considered high because it\'s designed for flexible and dynamic use in a complex data structure.',
                'tokens' => 273,
                'words' => 161,
                'characters' => 1025,
                'language' => 'Rubby',
                'code_label' => 'High',
            ),
            6 =>
            array (
                'id' => 14,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'heap-implementation',
                'promt' => 'Heap implementation',
                'code' => 'Sure, here\'s a high-level implementation of a heap data structure in Java:

                ```
                public class MaxHeap<T extends Comparable<T>> {
                private ArrayList<T> heapList;

                public MaxHeap() {
                heapList = new ArrayList<>();
                }

                public void insert(T item) {
                heapList.add(item);
                siftUp(heapList.size() - 1);
                }

                public T remove() {
                if (heapList.isEmpty()) {
                throw new NoSuchElementException("Heap is empty");
                }
                T root = heapList.get(0);
                T last = heapList.remove(heapList.size() - 1);
                if (!heapList.isEmpty()) {
                heapList.set(0, last);
                siftDown(0);
                }
                return root;
                }

                private void siftUp(int index) {
                int parentIndex = (index - 1) / 2;
                if (parentIndex >= 0 && heapList.get(index).compareTo(heapList.get(parentIndex)) > 0) {
                swap(parentIndex, index);
                siftUp(parentIndex);
                }
                }

                private void siftDown(int index) {
                int leftChildIndex = 2 * index + 1;
                int rightChildIndex = 2 * index + 2;
                int maxIndex = index;
                if (leftChildIndex < heapList.size() && heapList.get(leftChildIndex).compareTo(heapList.get(maxIndex)) > 0) {
                maxIndex = leftChildIndex;
                }
                if (rightChildIndex < heapList.size() && heapList.get(rightChildIndex).compareTo(heapList.get(maxIndex)) > 0) {
                maxIndex = rightChildIndex;
                }
                if (maxIndex != index) {
                swap(index, maxIndex);
                siftDown(maxIndex);
                }
                }

                private void swap(int i, int j) {
                T temp = heapList.get(i);
                heapList.set(i, heapList.get(j));
                heapList.set(j, temp);
                }
                }
                ```

                This implementation uses an array-based representation of the heap, where the children of an element at index `i` are located at indices `2i+1` and `2i+2`. The `siftUp` and `siftDown` methods are used to maintain the heap property after inserting and removing elements, respectively. `siftUp` recursively swaps an element with its parent until it is no longer greater than its parent, while `siftDown` recursively swaps an element with its larger child until it is no longer smaller than either of its children. The `MaxHeap` class is templated to allow for comparable elements of any type to be stored in the heap.',
                'tokens' => 589,
                'words' => 265,
                'characters' => 2339,
                'language' => 'Java',
                'code_label' => 'High',
            ),
            7 =>
            array (
                'id' => 15,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'string-operation',
                'promt' => 'String operation',
                'code' => 'Sure, here\'s an easy level code for a common string operation in PHP which is concatenation:

                ```php
                $name = "John";
                $lastname = "Doe";
                $fullname = $name . " " . $lastname;
                echo $fullname;
                ```

                This code concatenates the `$name` and `$lastname` variables with a space in between and saves the result in the `$fullname` variable. Finally, it uses `echo` to display the full name on the screen.',
                'tokens' => 134,
                'words' => 59,
                'characters' => 392,
                'language' => 'PHP',
                'code_label' => 'Easy',
            ),
            8 =>
            array (
                'id' => 16,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'fibonacci-series',
                'promt' => 'Fibonacci Series',
                'code' => 'Sure, here\'s an easy Ruby code for printing the Fibonacci series:

                ```ruby
                def fibonacci(n)
                if n <= 1
                return n
                else
                return fibonacci(n-1) + fibonacci(n-2)
                end
                end

                # Printing the first 10 numbers of Fibonacci series
                for i in 0..9
                puts fibonacci(i)
                end
                ```

                This code defines a function `fibonacci(n)` that takes a number `n` and returns the `n`-th term of the Fibonacci series. The function is implemented using a recursive algorithm that checks the base cases of `n = 0` and `n = 1`, and recursively calculates the other terms using the formula `fn = fn-1 + fn-2`.

                The last part of the code prints the first 10 numbers of the Fibonacci series by calling the `fibonacci()` function for `n` values from 0 to 9. You can customize this to print any number of terms of the series by changing the `for` loop range accordingly.',
                'tokens' => 257,
                'words' => 136,
                'characters' => 838,
                'language' => 'Rubby',
                'code_label' => 'Easy',
            ),
            9 =>
            array (
                'id' => 19,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'write-me-a-pyramid-program-0',
                'promt' => 'Write me a pyramid program',
                'code' => 'Sure, here\'s a simple Java program that prints a pyramid of stars:

                ```java
                import java.util.Scanner;

                public class Pyramid {
                public static void main(String[] args) {
                Scanner scanner = new Scanner(System.in);
                System.out.print("Enter number of rows: ");
                int rows = scanner.nextInt();

                for (int i = 1; i <= rows; i++) {
                for (int j = 1; j <= rows - i; j++) {
                System.out.print(" ");
                }
                for (int k = 1; k <= 2 * i - 1; k++) {
                System.out.print("*");
                }
                System.out.println();
                }
                }
                }
                ```

                Explanation:
                1. We first prompt the user to input the number of rows for the pyramid, and store it in the variable `rows`.
                2. We use nested loops to construct the pyramid. The outer loop runs from 1 to `rows` and controls the number of rows in the pyramid.
                3. The inner loop (nested in the outer loop) prints white space before the stars start to appear. It uses the formula `rows - i` to determine how many spaces to print for a given row `i`.
                4. The second inner loop (also nested in the outer loop) prints the stars. It uses the formula `2 * i - 1` to determine how many stars to print for a given row `i`.
                5. The `println()` method is called to move to the next line after each row is printed.

                Sample Output:
                ```
                Enter number of rows: 5
                *
                ***
                *****
                *******
                *********
                ```',
                'tokens' => 382,
                'words' => 208,
                'characters' => 1403,
                'language' => 'Java',
                'code_label' => 'High',
            ),
            10 =>
            array (
                'id' => 20,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'permutation',
                'promt' => 'Permutation',
                'code' => 'Sure, here\'s an easy PHP code for checking if two arrays are permutations of each other:

                ```
                function isPermutation($arr1, $arr2) {
                if(count($arr1) != count($arr2)){
                return false;
                }
                $count1 = array_count_values($arr1);
                $count2 = array_count_values($arr2);
                foreach($count1 as $key => $value){
                if(!isset($count2[$key]) || $count2[$key] != $value){
                return false;
                }
                }
                return true;
                }
                ```

                This code takes in two arrays `$arr1` and `$arr2`, and checks if they are permutations of each other. It first checks if the two arrays have the same length, which is a necessary condition for two arrays to be permutations of each other. It then uses the `array_count_values()` function to count the occurrences of each element in both arrays. Finally, it checks if the counts of corresponding elements in both arrays match. If they all match, it returns `true`, indicating that the two arrays are permutations of each other. Otherwise, it returns `false`.',
                'tokens' => 277,
                'words' => 148,
                'characters' => 973,
                'language' => 'PHP',
                'code_label' => 'High',
            ),
            11 =>
            array (
                'id' => 21,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'connect-to-mysql-database',
                'promt' => 'Connect to MySQL database',
                'code' => 'Sure, here\'s an example code for connecting to MySQL database in PHP:

                ```php
                // Database configuration
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "example_db";

                // Create connection
                $conn = mysqli_connect($host, $username, $password, $database);

                // Check connection
                if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                }

                echo "Connected to MySQL database successfully";
                ```

                This code assumes that you have a MySQL server installed on your local machine with the default username ("root") and no password. Adjust the values of `$host`, `$username`, `$password`, and `$database` to match your own MySQL server configuration.

                Once the connection is successful, the code will echo a message confirming the connection.',
                'tokens' => 200,
                'words' => 100,
                'characters' => 761,
                'language' => 'PHP',
                'code_label' => 'Easy',
            ),
            12 =>
            array (
                'id' => 22,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'simple-calculator',
                'promt' => 'Simple calculator',
                'code' => 'Sure, here\'s the code for a simple calculator in Ruby with a high code level:

                ```ruby
                # Define the Calculator class
                class Calculator

                # Define the constructor method
                def initialize
                # Set the initial values of the instance variables to 0
                @num1 = 0
                @num2 = 0
                end

                # Define the method to get and validate user input for numbers
                def get_numbers
                # Get the first number from the user and validate it
                while true
                print "Enter the first number: "
                @num1 = gets.chomp.to_f
                if @num1.to_s == "0"
                puts "Invalid input. Please enter a number other than 0."
                else
                break
                end
                end

                # Get the second number from the user and validate it
                while true
                print "Enter the second number: "
                @num2 = gets.chomp.to_f
                if @num2.to_s == "0"
                puts "Invalid input. Please enter a number other than 0."
                else
                break
                end
                end
                end

                # Define the method to perform addition
                def add
                @num1 + @num2
                end

                # Define the method to perform subtraction
                def subtract
                @num1 - @num2
                end

                # Define the method to perform multiplication
                def multiply
                @num1 * @num2
                end

                # Define the method to perform division
                def divide
                @num1 / @num2
                end

                end

                # Create a new instance of the Calculator class
                calculator = Calculator.new

                # Prompt the user for input and perform the requested operation
                while true
                puts "Enter the operation you want to perform (+, -, *, /):"
                operation = gets.chomp
                case operation
                when "+"
                calculator.get_numbers
                puts "#{calculator.add}"
                when "-"
                calculator.get_numbers
                puts "#{calculator.subtract}"
                when "*"
                calculator.get_numbers
                puts "#{calculator.multiply}"
                when "/"
                calculator.get_numbers
                puts "#{calculator.divide}"
                else
                puts "Invalid operation. Please enter +, -, *, or /."
                end
                end
                ```

                The code is written in object-oriented style, with a `Calculator` class defining all necessary methods. The `get_numbers` method ensures that the user inputs valid numbers other than 0 for calculations. The program runs continuously until the user decides to exit.',
                'tokens' => 574,
                'words' => 295,
                'characters' => 2145,
                'language' => 'Rubby',
                'code_label' => 'High',
            ),
            13 =>
            array (
                'id' => 23,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'recursively-reverse-a-string',
                'promt' => 'Recursively reverse a string',
                'code' => 'Here is an easy level Ruby code to recursively reverse a string:

                ```
                def reverse_string(str)
                if str.length <= 1
                return str
                else
                return reverse_string(str[1..-1]) + str[0]
                end
                end

                puts reverse_string("hello") #=> "olleh"
                ```

                In this code, we first check if the length of the string is less than or equal to 1. If it is, we simply return the string since it only has one character. Otherwise, we recursively call the function on the remaining part of the string (excluding the first character) and append the first character at the end. Finally, we return the reversed string.',
                'tokens' => 184,
                'words' => 98,
                'characters' => 591,
                'language' => 'Rubby',
                'code_label' => 'High',
            ),
            14 =>
            array (
                'id' => 24,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'create-a-custom-subtraction-function',
                'promt' => 'Create a custom subtraction function',
                'code' => 'Sure, here\'s an easy-level code for creating a custom subtraction function in Ruby:

                ```ruby
                def custom_subtraction(x, y)
                return x - y
                end
                ```

                This function takes two parameters `x` and `y`, and then simply returns the difference between `x` and `y` using the minus operator (-). You can call this function by passing in two values like this:

                ```ruby
                result = custom_subtraction(10, 5)
                puts result
                ```

                This will output `5`, which is the result of `10 - 5`. Feel free to customize the function to fit your specific needs!',
                'tokens' => 171,
                'words' => 85,
                'characters' => 525,
                'language' => 'Rubby',
                'code_label' => 'Medium',
            ),
            15 =>
            array (
                'id' => 25,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'sum-of-digits',
                'promt' => 'Sum of digits',
                'code' => 'Here\'s an example code in Ruby that calculates the sum of digits in a given number:

                ```
                def sum_of_digits(number)
                sum = 0
                number.to_s.each_char do |digit|
                sum += digit.to_i
                end
                return sum
                end

                # example usage:
                puts sum_of_digits(123) #=> 6
                puts sum_of_digits(456789) #=> 39
                ```

                In this code, the `sum_of_digits` method takes a parameter named `number`. The method initializes a variable named `sum` to 0 and converts the input number to a string to iterate over each digit.

                Then, the code uses `each_char` method to loop over each character in the string. Each character (which represents a digit in the number) is then converted to an integer using `to_i` method and added to the `sum` variable.

                Finally, the `sum` variable is returned as the result of the function.

                This is a medium level code as it involves basic loops and string manipulation.',
                'tokens' => 251,
                'words' => 147,
                'characters' => 864,
                'language' => 'Rubby',
                'code_label' => 'Medium',
            ),
            16 =>
            array (
                'id' => 26,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'calculate-a-javelin-throw',
                'promt' => 'Calculate a javelin throw',
                'code' => 'Sure, here\'s an implementation of a javelin throw calculator in Ruby:

                ```ruby
                class JavelinThrowCalculator
                GRAVITY = 9.81 # m/s^2

                def initialize(velocity, angle, height)
                @velocity = velocity # m/s
                @angle = angle # degrees
                @height = height # m
                end

                def calculate_distance
                angle_in_radians = degrees_to_radians(@angle)
                (@velocity**2 * Math.sin(2 * angle_in_radians)) / GRAVITY
                end

                def calculate_height_at_distance(distance)
                angle_in_radians = degrees_to_radians(@angle)
                (@height + distance * Math.tan(angle_in_radians) -
                0.5 * GRAVITY * (distance**2) / (@velocity**2 * Math.cos(angle_in_radians)**2))
                end

                private

                def degrees_to_radians(degrees)
                degrees * Math::PI / 180
                end
                end
                ```

                This implementation uses standard equations of motion for projectile motion in a vacuum. The `initialize` method takes the initial velocity, launch angle, and height of the throw. The `calculate_distance` method returns the distance traveled by the javelin. The `calculate_height_at_distance` method takes a distance and returns the height of the javelin at that distance along its trajectory.

                Note that this implementation does not take into account air resistance or other factors that may affect the accuracy of the calculation.',
                'tokens' => 355,
                'words' => 174,
                'characters' => 1277,
                'language' => 'Rubby',
                'code_label' => 'Medium',
            ),
            17 =>
            array (
                'id' => 27,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'calculate-a-javelin-throw-n',
                'promt' => 'Calculate a javelin throw',
                'code' => 'Sure, here is a code snippet that calculates the distance of a javelin throw in Java:

                ```
                import java.util.Scanner;

                public class JavelinThrow {
                public static void main(String[] args) {
                Scanner input = new Scanner(System.in);

                System.out.print("Enter the angle of the throw (in degrees): ");
                double angle = input.nextDouble();
                System.out.print("Enter the initial velocity of the throw (in meters per second): ");
                double velocity = input.nextDouble();
                System.out.print("Enter the height of the release point (in meters): ");
                double height = input.nextDouble();

                double radians = Math.toRadians(angle);

                double distance = (Math.pow(velocity, 2) * Math.sin(2 * radians)) / 9.81;

                double actualDistance = distance + height;

                System.out.println("The actual distance of the javelin throw is " + actualDistance + " meters.");
                }
                }
                ```

                This code prompts the user to enter the angle, initial velocity, and height of the javelin throw, converts the angle to radians, calculates the distance using the formula for projectile motion, and adds the height of the release point to get the actual distance of the throw. The code uses basic Java syntax and elementary mathematical functions, making it a medium level code example.',
                'tokens' => 310,
                'words' => 178,
                'characters' => 1266,
                'language' => 'Java',
                'code_label' => 'Medium',
            ),
            18 =>
            array (
                'id' => 28,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'to-find-the-difference-between-the-maximum-and-minimum-number-in-an-array',
                'promt' => 'To find the difference between the maximum and minimum number in an array.',
                'code' => 'Sure, here\'s the Java code to find the difference between the maximum and minimum numbers in an array:

                ```
                public static int findDifference(int[] arr) {
                int min = arr[0];
                int max = arr[0];
                for (int i = 1; i < arr.length; i++) {
                if (arr[i] < min) {
                min = arr[i];
                }
                if (arr[i] > max) {
                max = arr[i];
                }
                }
                return max - min;
                }
                ```

                Here, we first initialize `min` and `max` with the first element of the array `arr`. Next, we iterate over the array from the second element onwards, and for each element, we check if it\'s less than the current `min`. If it is, we update `min` to the new value. Similarly, if the element is greater than the current `max`, we update `max`. Finally, we return the difference between `max` and `min`.

                To use this method, simply pass in an array of integers to the method:

                ```
                int[] arr = {5, 3, 9, 1, 7};
                int diff = findDifference(arr);
                System.out.println("Difference between max and min: " + diff);
                ```

                This will output `Difference between max and min: 8` for the given array.',
                'tokens' => 336,
                'words' => 167,
                'characters' => 1082,
                'language' => 'Java',
                'code_label' => 'Medium',
            ),
            19 =>
            array (
                'id' => 29,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'to-find-the-difference-between-the-maximum-and-minimum-number-in-an-array-m',
                'promt' => 'To find the difference between the maximum and minimum number in an array.',
                'code' => 'Here\'s the Java code to find the difference between the maximum and minimum number in an array:

                ```
                public class ArrayDiff {
                public static void main(String[] args) {
                int[] numbers = {5, 10, 3, 8, 2};
                int max = numbers[0];
                int min = numbers[0];

                for(int i = 1; i < numbers.length; i++) {
                if(numbers[i] > max) {
                max = numbers[i];
                }
                else if(numbers[i] < min) {
                min = numbers[i];
                }
                }

                int difference = max - min;
                System.out.println("Difference between max and min: " + difference);
                }
                }
                ```

                In this code, we first initialize the `max` and `min` variables to the first element of the `numbers` array.

                We then loop through the elements of the array, comparing each one to the current `max` and `min` values. If we find a number greater than `max`, we update `max`, and if we find a number less than `min`, we update `min`.

                Finally, we calculate the difference between `max` and `min`, and output it to the console.',
                'tokens' => 305,
                'words' => 146,
                'characters' => 1062,
                'language' => 'Java',
                'code_label' => 'Medium',
            ),
            20 =>
            array (
                'id' => 30,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'complex-multithreading',
                'promt' => 'Complex Multithreading',
                'code' => 'Here\'s an example code snippet for implementing complex multithreading in Java at a medium code level:

                ```
                import java.util.concurrent.ExecutorService;
                import java.util.concurrent.Executors;

                public class MultithreadingExample {

                public static void main(String[] args) {

                // 1. Create an ExecutorService with a fixed thread pool of 5 threads
                ExecutorService executor = Executors.newFixedThreadPool(5);

                // 2. Execute tasks concurrently using the executor
                for (int i = 0; i < 10; i++) {
                executor.execute(new Task(i));
                }

                // 3. Shutdown the executor once all tasks have completed
                executor.shutdown();
                }
                }

                class Task implements Runnable {

                private int taskNumber;

                public Task(int taskNumber) {
                this.taskNumber = taskNumber;
                }

                @Override
                public void run() {

                // 4. Perform the task logic concurrently
                System.out.println("Task " + taskNumber + " is running on thread " + Thread.currentThread().getName());

                try {
                // Simulate the task taking some time to complete
                Thread.sleep(1000);
                } catch (InterruptedException e) {
                e.printStackTrace();
                }

                System.out.println("Task " + taskNumber + " has completed");
                }
                }
                ```

                In this example, we create an `ExecutorService` with a fixed thread pool of 5 threads. We then execute 10 `Task` objects concurrently using the executor, each performing some task logic. After all tasks have completed, we shutdown the executor.

                The `Task` class implements the `Runnable` interface and overrides the `run()` method to define the logic to be run concurrently. In this case, we simply output some information to the console and simulate each task taking some time to complete using `Thread.sleep()`.

                Overall, this code demonstrates how to use Java\'s built-in `ExecutorService` to implement complex multithreading at a medium code level.',
                'tokens' => 455,
                'words' => 232,
                'characters' => 2019,
                'language' => 'Java',
                'code_label' => 'Medium',
            ),
            21 =>
            array (
                'id' => 32,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'creating-deadlock',
                'promt' => 'Creating Deadlock',
                'code' => 'Creating a deadlock in PHP requires executing two or more threads that acquire exclusive locks on shared resources in a way that they are blocked waiting for each other to release the resource they need to proceed. Here is an example code that creates a deadlock:

                ```php
                <?php
                $resource1 = fopen(\'path/to/file1\', \'r+\');
                $resource2 = fopen(\'path/to/file2\', \'r+\');

                if (!$resource1 || !$resource2) {
                die(\'Failed to open files.\');
                }

                // Thread 1:
                if (flock($resource1, LOCK_EX)) {
                echo "Thread 1 has acquired a lock on resource 1.\\n";
                sleep(1);
                if (flock($resource2, LOCK_EX)) {
                echo "Thread 1 has acquired a lock on resource 2.\\n";
                } else {
                echo "Thread 1 failed to acquire a lock on resource 2.\\n";
                }
                // Releases lock on resource 2:
                flock($resource2, LOCK_UN);
                } else {
                echo "Thread 1 failed to acquire a lock on resource 1.\\n";
                }

                // Thread 2:
                if (flock($resource2, LOCK_EX)) {
                echo "Thread 2 has acquired a lock on resource 2.\\n";
                sleep(1);
                if (flock($resource1, LOCK_EX)) {
                echo "Thread 2 has acquired a lock on resource 1.\\n";
                } else {
                echo "Thread 2 failed to acquire a lock on resource 1.\\n";
                }
                // Releases lock on resource 1:
                flock($resource1, LOCK_UN);
                } else {
                echo "Thread 2 failed to acquire a lock on resource 2.\\n";
                }

                // Releases lock on resource 2:
                flock($resource2, LOCK_UN);

                fclose($resource1);
                fclose($resource2);
                ?>
                ```

                In this code, two threads are created that acquire locks on two files in a different order. Thread 1 acquires a lock on file 1, then waits for a second before trying to acquire a lock on file 2. Thread 2 acquires a lock on file 2, then waits for a second before trying to acquire a lock on file 1. Both threads release one of the locks they acquired, but need to acquire another lock that is held by the other thread. Since they are blocked waiting for the other to release the lock, a deadlock is created and execution is stopped indefinitely.

                This code level is considered medium because it involves creating a multithreaded environment, acquiring locks on shared resources, and dealing with the possibility of deadlocks.',
                'tokens' => 590,
                'words' => 328,
                'characters' => 2165,
                'language' => 'PHP',
                'code_label' => 'Medium',
            ),
            22 =>
            array (
                'id' => 33,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'checking-if-two-strings-are-anagram',
                'promt' => 'Checking if two strings are Anagram',
                'code' => 'Here\'s a PHP code for checking if two strings are anagram:

                ```php
                function checkAnagram($str1, $str2) {
                $strArr1 = str_split(strtolower($str1)); // convert string1 to an array of characters
                $strArr2 = str_split(strtolower($str2)); // convert string2 to an array of characters

                sort($strArr1); // sort the characters of string1 alphabetically
                sort($strArr2); // sort the characters of string2 alphabetically

                $newStr1 = implode(\'\', $strArr1); // convert array1 back to a string
                $newStr2 = implode(\'\', $strArr2); // convert array2 back to a string

                return $newStr1 === $newStr2;
                }

                $str1 = "restful";
                $str2 = "fluster";

                if(checkAnagram($str1, $str2)) {
                echo \'The strings are anagram\';
                } else {
                echo \'The strings are not anagram\';
                }
                ```

                In this code, two strings are given as input and it checks whether both strings are anagram or not. First, both strings are converted to an array of characters using the `str_split()` function. Then, the `sort()` function is used to sort both arrays of characters alphabetically. Finally, both sorted arrays are converted back to strings using the `implode()` function and compared with each other using the `===` operator.

                The level of this code is medium since it requires knowledge of string manipulation functions and sorting algorithms.',
                'tokens' => 366,
                'words' => 185,
                'characters' => 1315,
                'language' => 'PHP',
                'code_label' => 'Medium',
            ),
            23 =>
            array (
                'id' => 34,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'java-program-for-rotating-a-linked-list',
                'promt' => 'Java Program For Rotating A Linked List',
                'code' => 'Sure, here is the Java program to rotate a linked list:

                ```
                public class LinkedListRotation {

                static Node head; // head of the linked list

                static class Node {
                int data;
                Node next;

                Node(int d) {
                data = d;
                next = null;
                }
                }

                void rotate(int k) {
                if (k == 0)
                return;

                Node current = head;

                int count = 1;
                while (count < k && current != null) {
                current = current.next;
                count++;
                }

                if (current == null)
                return;

                Node kthNode = current;

                while (current.next != null)
                current = current.next;

                current.next = head;
                head = kthNode.next;
                kthNode.next = null;
                }

                void push(int new_data) {
                Node new_node = new Node(new_data);
                new_node.next = head;
                head = new_node;
                }

                void printList() {
                Node temp = head;
                while (temp != null) {
                System.out.print(temp.data + " ");
                temp = temp.next;
                }
                }

                public static void main(String args[]) {
                LinkedListRotation llist = new LinkedListRotation();

                // Add nodes to the linked list
                llist.push(60);
                llist.push(50);
                llist.push(40);
                llist.push(30);
                llist.push(20);
                llist.push(10);

                System.out.println("Linked List before rotation : ");
                llist.printList();

                llist.rotate(4);

                System.out.println("\\nLinked List after rotation : ");
                llist.printList();
                }
                }
                ```

                Code Explanation:
                - `Node` class: Represents each node of the linked list. It has data and next attributes to store the data and the reference to the next node.
                - `rotate` method: This method accepts an integer value (k) representing the number of positions to be rotated. It checks if the k value is 0, if yes then it returns without any rotation. If the k value is greater than the size of the linked list, then it also does nothing. If everything above checks, then it rotates the linked list k times.
                - `push` method: Adds a new node to the head of the linked list.
                - `printList` method: Prints the linked list data.
                - `main` method: Creates an object of `LinkedListRotation` class, adds some nodes to the linked list, prints the linked list before and after the rotation, then rotates it by calling the `rotate` method.',
                'tokens' => 594,
                'words' => 310,
                'characters' => 2424,
                'language' => 'Java',
                'code_label' => 'Medium',
            ),
            24 =>
            array (
                'id' => 35,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'create-a-java-singleton-class',
                'promt' => 'Create a Java Singleton class',
                'code' => 'Here\'s an example of creating a Java Singleton class:

                ```
                public class MySingleton {
                private static MySingleton instance;

                private MySingleton() {}

                public static MySingleton getInstance() {
                if (instance == null) {
                instance = new MySingleton();
                }
                return instance;
                }

                // Other methods and properties...
                }
                ```

                This code creates a singleton class named `MySingleton`. The `instance` variable is declared as a private static field, which means it\'s accessible to all instances of the class but only one instance can exist at a time. The constructor is also declared as private, which means it can only be called from within the class.

                The `getInstance()` method checks whether an instance already exists, and if not, creates and returns a new instance. This ensures that only one instance is created throughout the lifetime of the program, no matter how many times `getInstance()` is called.

                To use the `MySingleton` class, you would simply call `MySingleton.getInstance()` to get the single instance of the class.',
                'tokens' => 255,
                'words' => 148,
                'characters' => 1082,
                'language' => 'Java',
                'code_label' => 'Medium',
            ),
            25 =>
            array (
                'id' => 36,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'write-three-java-lambda-expressions',
                'promt' => 'Write three Java lambda expressions',
                'code' => 'Sure, here are three Java lambda expressions with medium code level:

                1. Lambda expression that filters a list of integers greater than a specific value:

                ```
                List<Integer> numbers = Arrays.asList(1, 2, 3, 4, 5, 6, 7, 8, 9);
                int threshold = 5;

                List<Integer> filteredNumbers = numbers.stream()
                .filter(n -> n > threshold)
                .collect(Collectors.toList());
                ```

                2. Lambda expression that sorts a list of strings in descending order by their length:

                ```
                List<String> words = Arrays.asList("apple", "banana", "cherry", "date", "elderberry");

                List<String> sortedWords = words.stream()
                .sorted((a, b) -> b.length() - a.length())
                .collect(Collectors.toList());
                ```

                3. Lambda expression that calculates the area of a rectangle given its length and width:

                ```
                DoubleUnaryOperator areaCalculator = (length, width) -> length * width;

                double length = 5.0;
                double width = 3.0;

                double area = areaCalculator.applyAsDouble(length, width);
                ```',
                'tokens' => 276,
                'words' => 116,
                'characters' => 1074,
                'language' => 'Java',
                'code_label' => 'Medium',
            ),
            26 =>
            array (
                'id' => 37,
                'user_id' => 2,
                'model' => 'gpt-3.5-turbo-0301',
                'slug' => 'write-a-method-to-determine-consecutive-numbers',
                'promt' => 'Write a method to determine consecutive numbers',
                'code' => 'Sure, here\'s a code snippet in PHP that checks whether a given array of integers contain any consecutive numbers or not. This code uses a medium level approach to solve the problem.

                ```
                function hasConsecutiveNumbers($nums) {
                if (count($nums) < 2) {
                return false;
                }

                sort($nums);

                for ($i = 1; $i < count($nums); $i++) {
                if ($nums[$i] - $nums[$i - 1] !== 1) {
                return false;
                }
                }

                return true;
                }
                ```

                This method takes an array of integers as input and checks whether the array contains consecutive numbers or not. If the array has less than two numbers, it returns false (as a single number or empty array cannot have consecutive numbers). It then sorts the array so that we can easily check consecutive numbers. Then, it loops through the sorted array and checks whether the difference between the current and previous numbers is 1. If the difference is not 1, it means that the array doesn\'t have consecutive numbers and returns false. Finally, if the loop completes without finding any breaks, it means that the array has consecutive numbers and it returns true.',
                'tokens' => 294,
                'words' => 170,
                'characters' => 1125,
                'language' => 'PHP',
                'code_label' => 'Medium',
            ),
        ));


    }
}
