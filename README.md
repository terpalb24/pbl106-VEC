<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->

<a id="readme-top"></a>

<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->

<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![Unlicense License][license-shield]][license-url]

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <p align="center">
    Join us to enhance your attendance event management experience!
    <br />
    <a href="#">View Demo</a>
    ·
    <a href="mailto:vec.pbl@gmail.com">Report Bug</a>
    ·
    <a href="mailto:vec.pbl@gmail.com">Request Feature</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->

## About The Project

[![Product Name Screen Shot][product-screenshot]](https://pbl-vec.my.id)

Virtual Event Check-in (VEC) is a digital solution designed to facilitate the recording of participant attendance at various types of online events such as webinars, workshops, seminars, and conferences. This application allows event organizers to manage participant attendance effectively and efficiently.s

Our Application Features :

- Register & Login
- Event Management
- Participant Attendance
- Attendance Management
- Account Settings

Virtual Event Check-in (VEC) provides practical features for event organizers. The application can be accessed online through a web browser. Event organizers can send a registration link for participant attendance through WhatsApp, Email, or Social Media platforms. Additionally, the application also provides a feature to automatically generate attendance reports that can be easily downloaded in Excel format.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

This is the language, tools, framework and libraries used in creating the Virtual Event Check-in application.

- [![HTML5][HTML5-shield]][HTML5-url]
- [![PHP][PHP-shield]][PHP-url]
- [![JavaScript][JavaScript-shield]][JavaScript-url]
- [![VSCODE][VSCODE.com]][VSCODE.url]
- [![GitHub][GitHub-shield]][GitHub-url]
- [![Bootstrap][Bootstrap.com]][Bootstrap-url]
- [![ionicons][ionicon-shield]][ionicon-url]
- [![SweetAlert][sweetalert-shield]][sweetalert-url]
- [![fpdf][fpdf-shield]][fpdf-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->

## Getting Started

There are several steps that must be taken to run the Virtual Event Check-in application.

### Prerequisites

This is an example of how to list things you need to use the software and how to install them.

- Install Web Server
  - Windows
    You can use XAMPP to run web server.
    ```sh
    https://www.apachefriends.org/download.html
    ```
  - Ubuntu
    Install Apache2 for run http port(80).
    ```sh
    sudo apt update
    sudo apt install apache2
    ```
    Install PHP
    ```sh
    sudo apt install php
    ```
    Install MySQL
    ```sh
    sudo apt install mysql-server
    ```
    _To configure, please refer to the [Documentation](https://ubuntu.com/server/docs/install-and-configure-a-mysql-server)_
    Install PhpMyAdmin
    ```sh
    sudo apt install phpmyadmin
    ```
    _To configure, please refer to the [Documentation](https://ubuntu.com/server/docs/how-to-install-and-configure-phpmyadmin)_

### Installation

_To configure the application, follow the steps below._

1. Clone the repo
   ```sh
   git clone https://github.com/vec-pbl/VEC.git
   ```
2. Extract the files from the your webserver directory.
   ```sh
   ex for ubuntu : /var/www/html
   ```
3. Run your webserver
   Check your apache2 status.
   ```sh
   sudo systemctl status apache2
   ```
4. Open your browser and type
   ```sh
   http://localhost/phpmyadmin/
   ```
   Login in phpmyadmin username default "root" and no password.
5. Create a new database and name it `ltewezcf_vec`
6. Click database `ltewezcf_vec`, and import `ltewezcf_vec.sql` from folder.
7. Done, You can use the application in
  ```sh
   http://localhost/
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTRIBUTING -->

### Top contributors:

<a href="https://github.com/vec-pbl/VEC/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=vec-pbl/VEC" />
</a>

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LICENSE -->

## License

Distributed under the Unlicense License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->

## Contact

Email - vec.pbl@gmail.com

Project Link: [https://github.com/vec-pbl/VEC](https://github.com/vec-pbl/VEC)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->

## Acknowledgments

Use this space to list resources you find helpful and would like to give credit to. I've included a few of my favorites to kick things off!

- [Choose an Open Source License](https://choosealicense.com)
- [GitHub Emoji Cheat Sheet](https://www.webpagefx.com/tools/emoji-cheat-sheet)
- [Malven's Flexbox Cheatsheet](https://flexbox.malven.co/)
- [Malven's Grid Cheatsheet](https://grid.malven.co/)
- [Img Shields](https://shields.io)
- [GitHub Pages](https://pages.github.com)
- [Font Awesome](https://fontawesome.com)
- [React Icons](https://react-icons.github.io/react-icons/search)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[contributors-shield]: https://img.shields.io/github/contributors/vec-pbl/VEC.svg?style=for-the-badge
[contributors-url]: https://github.com/vec-pbl/VEC/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/vec-pbl/VEC.svg?style=for-the-badge
[forks-url]: https://github.com/vec-pbl/VEC/network/members
[stars-shield]: https://img.shields.io/github/stars/vec-pbl/VEC.svg?style=for-the-badge
[stars-url]: https://github.com/vec-pbl/VEC/stargazers
[issues-shield]: https://img.shields.io/github/issues/vec-pbl/VEC.svg?style=for-the-badge
[issues-url]: https://github.com/vec-pbl/VEC/issues
[license-shield]: https://img.shields.io/github/license/vec-pbl/VEC.svg?style=for-the-badge
[license-url]: https://pbl-vec.my.id/LICENSE
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/othneildrew
[product-screenshot]: assets/img/readme.png
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[VSCODE.com]: https://img.shields.io/badge/VSCode-0078D4?style=for-the-badge&logo=visual%20studio%20code&logoColor=white
[VSCODE.url]: https://code.visualstudio.com/
[JavaScript-shield]: https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E
[JavaScript-url]: https://www.javascript.com/
[PHP-shield]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://www.php.net/
[GitHub-shield]: https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white
[GitHub-url]: https://github.com/
[HTML5-shield]: https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white
[HTML5-url]: https://www.google.com/search?q=html&sca_esv=35aa2c76c27153e3&sxsrf=ADLYWIJHY-u2SSY7sARXtFKmLnKxgk88nw%3A1734520066865&ei=Aq1iZ6K7NO_CjuMPmoK4mAk&ved=0ahUKEwiixMPjlrGKAxVvoWMGHRoBDpMQ4dUDCBA&uact=5&oq=html&gs_lp=Egxnd3Mtd2l6LXNlcnAiBGh0bWwyChAjGIAEGCcYigUyCBAAGIAEGLEDMggQABiABBixAzILEAAYgAQYsQMYgwEyBRAAGIAEMgoQABiABBhDGIoFMgoQABiABBhDGIoFMgoQABiABBhDGIoFMgUQABiABDIFEAAYgARI8wRQuQJYuQJwAXgBkAEAmAFeoAFeqgEBMbgBA8gBAPgBAZgCAqACZ8ICChAAGLADGNYEGEfCAg0QABiABBiwAxhDGIoFmAMAiAYBkAYKkgcBMqAHtgU&sclient=gws-wiz-serp
[ionicon-shield]: https://img.shields.io/badge/Ionicons-3880FF?style=for-the-badge&logo=ionic&logoColor=white
[ionicon-url]: https://ionic.io/ionicons
[sweetalert-shield]: https://img.shields.io/badge/SweetAlert2-3880FF?style=for-the-badge
[sweetalert-url]: https://sweetalert2.github.io/
[fpdf-shield]: https://img.shields.io/badge/FPDF-3880FF?style=for-the-badge
[fpdf-url]: https://www.fpdf.org/
