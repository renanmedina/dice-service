data "aws_ami" "ubuntu" {
  most_recent = true

  filter {
    name   = "name"
    values = ["ubuntu/images/hvm-ssd/ubuntu-focal-20.04-amd64-server-*"]
  }

  filter {
    name   = "virtualization-type"
    values = ["hvm"]
  }

  owners = ["099720109477"] # Canonical
}

resource "tls_private_key" "dice-service-rsa" {
  algorithm = "RSA"
  rsa_bits  = 4096
}

resource "local_file" "dice-service-private-rsa-key" {
  content  = tls_private_key.dice-service-rsa.private_key_openssh
  filename = "${path.module}/ssh-keys/dice-service-host-rsa.pem"
}

resource "aws_key_pair" "dice-service-host" {
  key_name = "dice-service-host-access-keys"
  public_key = tls_private_key.dice-service-rsa.public_key_openssh
}

resource "aws_instance" "dice-service-host" {
  ami           = data.aws_ami.ubuntu.id
  instance_type = "t3.micro"
  key_name = aws_key_pair.dice-service-host.key_name

  tags = {
    Service = "dice-service"
    Environment = "production"
  }
}
