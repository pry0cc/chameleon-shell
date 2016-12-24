#!/bin/bash
echo "Removing existing container PHPshell. Press enter to continue, CTRL+C to exit"
read
sudo docker rm -f phpshell
echo "Starting container with name phpshell"
sudo docker run -d --name phpshell -v $(pwd):/app -p 80:80 tutum/lamp
echo "Go to http://127.0.0.1/shell.php to test."
