<h1 align="center">🚀 Blog en Laravel 12 🚀</h1>
<p align="center">Este es un proyecto en desarrollo de un blog utilizando Laravel 12.</p>

---

<h2>📌 Requisitos</h2>
<p>Antes de empezar, asegúrate de tener instalado lo siguiente:</p>
<ul>
  <li><b>PHP 8.2 o superior</b></li>
  <li><b>Composer</b></li>
  <li><b>Node.js y NPM</b> (para Vite)</li>
  <li><b>MySQL</b></li>
</ul>

---

<h2>📥 Instalación</h2>

<h3>📌 Clonar el repositorio</h3>
<p>Clona el repositorio en tu máquina y accede a la carpeta:</p>

```bash
git clone https://github.com/AbrahamCueva/blog.git
```
```bash
cd blog-laravel
```
<h3>📌 Instalar dependencias</h3> <p>Ejecuta los siguientes comandos para instalar las dependencias:</p>

```bash
composer install
```
```bash
npm install
```
<h3>📌 Configurar el entorno</h3> <p>Crea el archivo de configuración:</p>

```bash
cp .env.example .env
```
<p>Genera la clave de la aplicación:</p>

```bash
php artisan key:generate
```
<h2>⚙️ Configuración de la Base de Datos</h2> <p>Configura la base de datos en el archivo <code>.env</code>:</p>

```bash
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=tu_contraseña
```
<p>Ejecuta las migraciones y seeders:</p>

```bash
php artisan migrate --seed
```
<h2>🏃‍♂️ Ejecutar el Proyecto</h2> <h3>📌 Levantar el servidor de Laravel</h3>

```bash
php artisan serve
```
<h3>📌 Ejecutar Vite</h3> <p>Corre uno de los siguientes comandos en otra terminal:</p>

```bash
npm run dev
```
<h2>🌍 Acceso</h2> <p>Ahora puedes acceder a la aplicación en:</p> <p align="center"> <a href="http://127.0.0.1:8000" target="_blank"> <img src="https://img.shields.io/badge/Live%20Demo-127.0.0.1:8000-blue?style=for-the-badge" alt="Live Demo"> </a> </p>
<h2>📜 Licencia</h2> <p>Este proyecto está bajo la licencia <b>MIT</b>. Siéntete libre de usarlo y modificarlo.</p>
<h2>🙌 Contribuciones</h2> <p>Si deseas contribuir, siéntete libre de hacer un fork del repositorio y enviar un pull request con mejoras.</p> <p align="center">✨ Hecho con ❤️ por <b>AbrahamCueva</b> ✨</p>
