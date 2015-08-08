# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.vm.box = "scotch/box"
    config.vm.network "private_network", ip: "192.168.33.10"
    config.vm.hostname = "scotchbox"
    config.vm.synced_folder ".", "/var/www", :mount_options => ["dmode=770", "fmode=660"]
    
    # Optional NFS. Make sure to remove other synced_folder line too
    #config.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=666"] }

    config.vm.provision "shell", inline: <<-SHELL
      # Install OwnCloud development tool
      apt-get install -y python3-pip
      pip3 install ocdev

      # Set language envs
      echo "export LC_CTYPE=en_US.UTF-8" >> ~/.profile
      echo "export LC_ALL=en_US.UTF-8" >> ~/.profile

      # Use dev config for OwnCloud
      cd /var/www/public/config
      cp config.dev.php config.php
    SHELL
end