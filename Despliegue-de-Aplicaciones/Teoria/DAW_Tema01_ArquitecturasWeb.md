# Despliegue de aplicaciones web - Tema 1: Implantación de arquitecturas web

## 📌 Resumen Ejecutivo y Objetivos

La Unidad 1 estudia la base del despliegue de una aplicación web: qué es una arquitectura web, qué servicios y tecnologías la componen, qué modelos se han sucedido, qué plataformas la sostienen y cómo se instalan y ponen en producción Apache y Tomcat.

La arquitectura WWW provee un modelo flexible: los contenidos se presentan en formatos estándar y los localizan los *web browsers*, que envían requerimientos al servidor y reciben el dato codificado. Los estándares WWW definen nombres mediante URL (*Uniform Resource Locator*), un tipo por contenido, formatos estándar (HTML, ECMA, JavaScript) y protocolos que permiten a cualquier navegador hablar con cualquier servidor, principalmente HTTP sobre TCP/IP.

**Objetivos:**

- Identificar elementos, capas y modelos de una arquitectura web.
- Distinguir tecnologías de cliente y servidor y clasificar los tipos de aplicaciones.
- Comparar plataformas libres y propietarias (LAMP, WISA).
- Comprender la escalabilidad vertical, horizontal y en *cluster* y los balanceadores.
- Instalar y arrancar Apache y Tomcat, con su integración por *proxy* y AJP.
- Empaquetar y desplegar WAR e interpretar `web.xml`.

## 📖 Desarrollo Teórico Detallado

### 1. Aspectos generales de arquitecturas web

Los aspectos generales a destacar son: escalabilidad; separación de responsabilidades; portabilidad; componentes en los servicios de infraestructura; gestión de sesiones del usuario, y patrones de diseño.

El funcionamiento exige tres elementos:

| Elemento | Función |
|---|---|
| Proveedor | Diseña, desarrolla e implementa el servicio y lo pone disponible |
| Consumidor | Accede al componente para utilizar los servicios que presta |
| Agente | Enlace entre ambos para publicación, búsqueda y localización |

Genéricamente, la arquitectura web tiene tres capas: **base de datos** (MySQL o PostgreSQL), **servidores de aplicaciones web** (Apache, Tomcat, Resin) y **clientes** (Firefox, Explorer, Opera).

### 1.1. Evolución de los servicios web

Su evolución está ligada a Internet como red prestadora de servicios. Los factores impulsores son: contenido más dinámico ("instantáneo", con fuentes muy diferentes); ancho de banda menos costoso (vídeo y audio); almacenamiento más barato (cantidades masivas de datos), y el éxito de la computación extendida (cientos de millones de dispositivos, donde el ordenador deja de ser el más común y tecnologías como XML ganan importancia).

En los orígenes el entorno era estático, con páginas HTML apenas interactivas. La **Web 2.0** es la transición hacia aplicaciones que funcionan por la web y se enfocan al usuario final; sus tecnologías persiguen transformar software de escritorio hacia la web, separar hojas de estilo, potenciar el trabajo colaborativo y las redes sociales, y dar control total a los usuarios sobre su información.

### 1.2. Tecnologías asociadas a las aplicaciones web

Las aplicaciones web emplean páginas dinámicas que se ejecutan en el servidor y se muestran en el navegador del cliente que las pidió. El código que llega con la página, normalmente JavaScript, lo ejecuta el navegador.

| Tecnología | Lado | Características |
|---|---|---|
| ASP (*Active Server Pages*) | Servidor | Páginas Activas de Microsoft con IIS; hay versiones para Unix y Linux |
| CGI (*Common Gateway Interface*) | Servidor | Estándar antiguo para trasladar datos de una página al servidor; rutinas en Perl o C |
| CSS (*Cascading Style Sheets*) | Presentación | Separa contenido y presentación; un cambio afecta a las páginas vinculadas |
| Java | Cliente | Multiplataforma, orientado a objetos, aplicaciones o *applets*; GNU GPL |
| JavaScript | Cliente | Imágenes en movimiento, menús interactivos, juegos; más aceptado que VBScript |
| PHP (*Hypertext Preprocessor*) | Servidor | Similar a ASP, muy eficiente, acceso a bases de datos MySQL |
| VBScript (*Visual Basic Scripting*) | Cliente o servidor | Respuesta de Microsoft a JavaScript; orientado a Internet Explorer |

### 1.3. Tipos de aplicaciones web

Una aplicación web es una plataforma que automatiza procesos de servicios a usuarios. Según cómo se presenta y su contenido:

- **Estática**: en HTML, con objetos en movimiento (banners, GIF animados, vídeos).
- **Animada**: con FLASH, efectos animados continuados y diseños vanguardistas.
- **Dinámica**: con PHP y ASP, que estructuran el contenido y lo gestionan con un panel de control.
- **Portal**: acceso a secciones (foros, chats, correo, buscador, noticias).
- **Tienda virtual**: compra *on-line* por tarjeta, domiciliación o transferencia.
- **Gestor de Contenidos**: contenido actualizado con un panel intuitivo.

### 1.4. Arquitecturas web. Modelos

La arquitectura de un sitio web comprende los sistemas de organización de contenidos y los de recuperación y navegación. El estudio se centra en tres capas:

- **Presentación**: navegabilidad, validación de entrada y formateo de salida; es la capa que ve el usuario.
- **Negocio**: recibe peticiones, envía respuestas y verifica las reglas.
- **Acceso a datos**: almacenan, estructuran y recuperan los datos pedidos por negocio.

| Modelo | Descripción |
|---|---|
| Modelo 1 | CGI con procesos externos; presentación, negocio y datos se confundían en un *script* Perl |
| Modelo 1.5 | Java con JSP y *servlets*; la presentación va en las JSP y los *beans* asumen negocio y datos |
| Modelo 2 | Añade el patrón MVC y un controlador de navegación; negocio en *javabeans* |
| Modelo 2X | Multicanal (PDA, móvil, navegador) con plantillas XSL que transforman datos XML |

### 1.5. Plataformas web libres y propietarias

Una plataforma web es el entorno para diseñar y ejecutar un sitio web: sistema operativo, servidor web, gestor de bases de datos y lenguaje interpretado.

| Plataforma | SO | Servidor | Base de datos | Lenguaje | Licencia |
|---|---|---|---|---|---|
| LAMP | Linux | Apache | MySQL | PHP (o Perl/Python) | Libre |
| WISA | Windows | IIS | SQL Server | ASP o ASP.NET | Propietaria |
| WAMP | Windows | Apache | MySQL | PHP | Libre (desarrollo local) |
| WIMP | Windows | IIS | MySQL | PHP | Mixta |

### 1.6. Escalabilidad

El número de usuarios puede crecer vertiginosamente, así que la aplicación debe escalar sin alterar su comportamiento. Puede ser **vertical** (*upgrades* a cada nodo), **horizontal** (más nodos) o en **cluster** (agrupaciones).

La vertical convierte la separación lógica en capas en separación física mediante *middlewares*: una máquina por capa, o los elementos de una capa repartidos entre varias. La horizontal clona el sistema y balancea la carga con un dispositivo externo:

| Balanceador | Funcionamiento | Ventaja / Limitación |
|---|---|---|
| Software | Examina el paquete HTTP e identifica la sesión (`mod_jk`) | Mantiene la sesión en la misma máquina; permite usar el objeto sesión |
| Hardware | Algoritmos de reparto (Round Robin, LRU) | Muy rápido; no garantiza la sesión, obliga a cookies o base de datos |
| Hardware HTTP | Examina el paquete HTTP y mantiene la relación usuario-máquina | Más rápido que el software; solución muy aceptada |

Un *cluster* reparte la carga de forma transparente y, por replicación, garantiza la sesión (`HttpSession` en Java), aunque suele perder rendimiento.

### 2. Servidor web Apache

Un servidor web es un programa que se ejecuta de forma continua, espera peticiones de un cliente y contesta sirviendo la página o el mensaje de error. Apache, de código abierto y gratuito, se estructura en módulos activables al arrancar: **base**, **multiproceso** (puertos, aceptación y atención de peticiones) y **adicionales**. Se desarrolla en el proyecto httpd de la Apache Software Foundation, y su licencia permite derivados abiertos y cerrados.

### 2.1. Instalación y configuración

Instalación en Debian 6.0.1 Squeeze como root:

```bash
# apt-get install apache2
# apt-get install php5 mysql-client mysql-admin mysql-query-browser phpmyadmin
```

Se verifica con `http://localhost` o `http://127.0.0.1`: debe aparecer "It Works!". Desde código fuente:

```bash
cd /usr/local/src
wget http://apache.rediris.es//httpd/httpd-2.2.19.tar.gz
tar xvzf httpd-2.2.19.tar.gz
cd /usr/local/src/httpd-2.2.19
./configure --prefix=/usr/local/apache --enable-module=most --enable-mods-shared=most
make
make install
```

Sirve por defecto `/var/www/`, donde `index.html` contiene el "It Works!". Para más webs se usan **hosts virtuales**, como el ejemplo `/etc/apache2/sites-enabled/000-default`: varias web desde una IP con un puerto distinto cada una.

La configuración son directivas de texto plano; el archivo principal es `/etc/apache2/apache2.conf`, que admite otros con `Include`. Sólo reconoce cambios al reiniciar.

| Directiva | Función |
|---|---|
| `ServerTokens` | Información que Apache aporta sobre sí mismo |
| `Alias` | Direcciona a una carpeta fuera de `DocumentRoot` |
| `ServerName` | Nombre del servidor; `localhost` si no hay dominio |
| `CustomLog` | Archivo `.log` de accesos |
| `ServerAdmin` | Correo del administrador; `webmaster@localhost` |
| `Listen` | Puerto de escucha; se cambia en `/etc/apache2/ports.conf` |
| `DocumentRoot` | Directorio del sitio; por defecto `/var/www` |

El servidor virtual predeterminado se edita en `/etc/apache2/sites-available/default`; para uno nuevo se copia con otro nombre.

### 2.2. Iniciar Apache

Si se instaló en `/usr/local/apache`:

```bash
/usr/local/apache/bin/apachectl configtest
/usr/local/apache/bin/apachectl start
```

`configtest` debe devolver "Syntax Ok". Si `Listen` usa el 80 (o un puerto menor) hacen falta privilegios de root. Tras abrir los logs, `httpd` sigue como root y lanza procesos hijo con menos privilegios que atienden peticiones. `apachectl` interpreta `start`, `restart` y `stop`. Para parar, reiniciar o arrancar:

```bash
# /etc/init.d/apache2 stop
# /etc/init.d/apache2 restart
# /etc/init.d/apache2 start
```

### 3. Aplicaciones web y servidores de aplicaciones

Una **aplicación web** es una aplicación informática que se ejecuta en un entorno web, con arquitectura cliente-servidor y un protocolo establecido: navegador, servidor web y comunicación HTTP.

Un **servidor de aplicaciones** proporciona aplicaciones a los equipos cliente, generalmente por Internet con HTTP. Se distingue del servidor web por el uso extensivo de contenido dinámico y su integración con bases de datos. Sus ventajas son la centralización y menor complejidad del desarrollo (las aplicaciones se ensamblan desde bloques del servidor) y la integridad de datos y código, pues las actualizaciones están garantizadas. Destaca J2EE de Sun Microsystems: nivel Cliente, nivel Medio (servidor web y servidor EJB, llamados contenedores) y nivel EIS (*Enterprise Information System*) con aplicaciones, archivos y bases de datos.

### 3.1. El servidor de aplicaciones Tomcat

Tomcat es el servidor web (incluye Apache) y de aplicaciones del proyecto Yakarta: gestiona solicitudes y respuestas HTTP y es contenedor de *servlets* y JSP. Incluye el compilador **Jasper**, que convierte las JSP en *servlets*. Un contenedor es un *shell* de ejecución que los maneja e invoca por cuenta del usuario.

| Contenedor | Descripción | Rendimiento |
|---|---|---|
| *Stand-alone* | Parte integral de un servidor web Java (modo por defecto) | Adecuado, pero la mayoría de servidores no son Java |
| Dentro-de-proceso | *Plugin* que abre una JVM en el servidor y usa JNI | Buen rendimiento, limitado en escalabilidad |
| Fuera-de-proceso | JVM externa, comunicación por IPC (sockets TCP/IP) | Peor respuesta, mejor escalabilidad y estabilidad |

Puede usarse como contenedor solitario (desarrollo) o como *plugin* de un servidor existente (Apache, IIS); en las opciones segunda y tercera se necesita un adaptador.

#### 3.1.1. Instalación y configuración básica

Es imprescindible tener JDK: las peticiones a Apache se redirigen a Tomcat con un conector Java.

```bash
aptitude search "?provides(java-runtime)"
apt-get install default-jre
```

Variables de entorno en `/etc/profile`:

```bash
JAVA_HOME=/usr/lib/jvm/java-6-openjdk/jre/
PATH=$PATH:$JAVA_HOME/bin
export PATH JAVA_HOME
```

```bash
source /etc/profile
```

Descarga, descompresión, ubicación y enlace:

```bash
# wget http://apache.rediris.es/tomcat/tomcat-6/v6.0.32/bin/apache-tomcat-6.0.32.tar.gz
# tar xvzf apache-tomcat-6.0.32.tar.gz
# mv -drfv apache-tomcat-6.0.32 /usr/local/
# ln -s /usr/local/apache-tomcat-6.0.32/ /usr/local/tomcat
```

El servicio se gestiona con el script `catalina`, con los parámetros `start` y `stop`. Se comprueba con `http://127.0.0.1:8080`.

#### 3.1.2. Iniciar Tomcat

Tomcat escucha en el 8080 y tiene su propio directorio. Apache intercepta las peticiones del 80 y deriva a Tomcat las necesarias; como *proxy* puede balancear entre una batería de tomcats, ampliando máquinas de forma transparente.

Apache busca en `/var/www` y Tomcat en `/usr/local/tomcat/webapps/ROOT`; para unificar la carpeta se edita `server.xml`:

```bash
# nano /usr/local/tomcat/conf/server.xml
```

Estableciendo `<Host name=”localhost” appBase=”/var/www”`. Luego se cargan los módulos de *proxy*:

```bash
# a2enmod proxy
# a2enmod proxy_ajp
# a2enmod proxy_balancer
# /etc/init.d/apache2 restart
```

**AJP** es un protocolo interno muy rápido con conexiones TCP persistentes; se emplea entre apache2 y Tomcat, aunque podría usarse HTTP al 8080. Su puerto por defecto es el 8009. En el host virtual se añade:

```apache
<Proxy balancer://tomcat_cluster>
Order allow,deny
Allow from all
BalancerMember ajp://localhost:8009
</Proxy>
ProxyPreserveHost On
ProxyPass /phpmyadmin/ !
ProxyPass / balancer://tomcat_cluster/
ProxyPassReverse / balancer://tomcat_cluster/
```

`Proxy balancer://tomcat_cluster` define el *cluster*; `BalancerMember` define un miembro con protocolo, IP y puerto; `ProxyPass /` le pasa la raíz y lo que cuelga de ella; `ProxyPreserveHost On` mantiene la cabecera host original. Por último, `DocumentRoot` y `<Directory /var/www/>` apuntan a `/var/www/ROOT`.

### 4. Estructura y despliegue de una aplicación web

Una aplicación web se compone de *servlets*, páginas JSP, HTML, imágenes, sonidos, texto y clases, empaquetables en varios contenedores. Un *servlet* es una aplicación Java que realiza un servicio específico en un servidor web. La especificación Servlet 2.2 define la estructura de directorios: el raíz lleva el nombre de la aplicación y es la raíz de documentos; todo lo que hay bajo él puede servirse excepto `META-INF` y `WEB-INF`, con los ficheros privados y las clases. En producción se empaqueta en un `.war`.

```text
/index.jsp
/WebContent/jsp/welcome.jsp
/WebContent/css/estilo.css
/WebContent/js/utils.js
/WebContent/img/welcome.jpg
/WEB-INF/web.xml
/WEB-INF/struts-config.xml
/WEB-INF/lib/struts.jar
/WEB-INF/src/com/empresa/proyecto/action/welcomeAction.java
/WEB-INF/classess/com/empresa/proyecto/action/welcomeAction.class
```

Genéricamente son tres capas: navegador web, tecnología web dinámica (PHP, Java Servlets, ASP) y base de datos, que almacena la información necesaria.

### 4.1. Archivos WAR

Su nombre procede de *Web Application Archive*; empaquetan aplicaciones web Java completas: *servlets* y JSP, contenido estático (HTML, imágenes) y otros recursos. Simplifican el despliegue (un fichero por servidor en un *cluster*) y aumentan la seguridad al impedir el acceso entre aplicaciones.

| Ruta | Contenido |
|---|---|
| `/` | HTML, CSS y elementos JSP (`*.html *.jsp *.css`) |
| `/WEB-INF/` | Configuración; el más importante, `web.xml` |
| `/WEB-INF/classes/` | Clases Java, normalmente los *servlets* |
| `/WEB-INF/lib/` | JAR de la aplicación (base de datos, librerías JSP) |

Se generan con IDE como NetBeans y Eclipse, Jbuilder de Borland o Jdeveloper de Oracle, y con **Ant**, considerada el `make` de Java aunque no es un IDE.

### 4.2. Despliegue de aplicaciones con Tomcat

Se despliega con archivos WAR o editando `web.xml` y `server.xml`. Los directorios de una aplicación compilada suelen ser `www`, `bin`, `src`, `tomcat` y `gwt-cache`: `www` contiene la interfaz y `bin` las clases Java. Pasos:

1. Copiar la carpeta de `www` en `webapps` de Tomcat.
2. Renombrarla con un nombre sencillo: será la carpeta de la aplicación.
3. Crear dentro `WEB-INF` (respetando mayúsculas).
4. Crear dentro `lib` y `classes`.
5. Copiar en `lib` las librerías (`.jar`).
6. Copiar el contenido de `bin` en `WEB-INF/classes`.
7. Crear en `WEB-INF` un `web.xml` con las rutas de los *servlets*.
8. Acceder por la ruta del HTML de entrada.

### 4.3. Descriptor de despliegue

Es un documento XML que describe el despliegue de una aplicación, módulo o componente; su información es declarativa y se cambia sin tocar el código. Toda aplicación aporta uno en `WEB-INF/web.xml`; en Tomcat, `<TOMCAT_HOME>/conf/web.xml` es el descriptor por defecto, que se ejecuta antes y sólo debe contener información general.

```xml
<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE web-app PUBLIC
"-//Sun Microsystems, Inc.//DTD Web Application 2.2//EN"
"http://java.sun.com/j2ee/dtds/web-app_2_2.dtd">
<web-app>
<!-- Tus definiciones van aquí -->
</web-app>
```

Entre `<web-app>` van los descriptores de *servlets*, con las etiquetas en este orden:

```xml
<servlet>
<servlet-name>nombre</servlet-name>
<servlet-class>package.nombre.MiClass</servlet-class>
</servlet>
```

Para probarlo, tras arrancar Tomcat se usa `http://{address}:{port}/{servletName}`, p. ej. `http://localhost:8080/Servlet_de_prueba`.

## 💡 Ejemplos Prácticos y Aplicaciones

**Plataforma AMP con XAMPP.** Hay paquetes que instalan una plataforma AMP entera, con versiones para Linux, Windows y Mac. Se descarga de "apachefriends", se descomprime como superusuario con `tar xvfz <paquete>` (en una subcarpeta de `/opt/`) y se arranca con `lampp start`; `http://localhost` muestra la ventana de XAMPP.

**Apache con Webmin.** Sobre Ubuntu con Webmin (configuración de sistemas vía web para Unix) se instala el paquete de Apache, se copia una página a `/var/www` ajustando permisos, se reinicia el servicio y se verifica con `http://127.0.0.1`. El vídeo crea además un *Virtual Host* en el puerto 81, configurando `/etc/apache2/ports.conf`.

**Integración Apache-Tomcat.** Apache recibe en el 80 y deriva por AJP al 8009 con un `balancer://tomcat_cluster` ampliable: escalabilidad invisible al usuario.

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

**Conceptos clave**

1. **URL**: modelo estándar de nombres en la WWW.
2. **HTTP sobre TCP/IP**: comunicación universal navegador-servidor.
3. **Tres capas**: base de datos, servidores de aplicaciones y clientes.
4. **Escalabilidad**: vertical (*upgrades*), horizontal (más nodos) y cluster.
5. **Balanceadores**: software (por sesión), hardware (por algoritmo) y hardware HTTP (examina el paquete).
6. **LAMP vs. WISA**: libre (Linux, Apache, MySQL, PHP) frente a propietaria (Windows, IIS, SQL Server, ASP.NET).
7. **Servidor web vs. de aplicaciones**: el primero sirve contenido; el segundo, contenido dinámico con BD.
8. **Tomcat**: contenedor de *servlets* y JSP de Yakarta.
9. **Jasper**: compilador que transforma las JSP en *servlets*.
10. **AJP**: protocolo interno rápido con TCP persistente; puerto 8009.
11. **WAR**: *Web Application Archive*, aplicación Java completa en una unidad.
12. **Descriptor de despliegue**: XML declarativo en `WEB-INF/web.xml`.

**Preguntas de autoevaluación**

1. *¿Podemos ver una página web sin servidor web?* Sí: abriendo archivos `.htm`, `.html` o `.xhtml` locales; el servidor sólo serviría para enviarla.
2. *¿Cuáles son los tres elementos de los servicios web?* Proveedor, consumidor y agente (publica, busca y localiza).
3. *¿En qué se diferencian ASP y JavaScript?* ASP se ejecuta en el servidor y genera los resultados; JavaScript se interpreta en el cliente.
4. *¿Qué caracteriza al Modelo 2 frente al 1.5?* Incorpora MVC y un controlador de navegación, con el negocio en *javabeans*.
5. *¿Qué plataforma es libre y cuáles son sus componentes?* LAMP: Linux, Apache, MySQL y PHP (o Perl/Python).
6. *¿En qué escalabilidad se emplean los balanceadores?* En la horizontal: software, hardware o hardware HTTP.
7. *¿Qué riesgo tiene un balanceador hardware puro?* No garantiza la sesión: obliga a cookies o base de datos.
8. *¿Son equivalentes Apache y Tomcat?* No: Apache es sólo servidor web; Tomcat, servidor de aplicaciones.
9. *¿Qué es un archivo WAR?* Un archivo que empaqueta aplicaciones web completas; no es un compresor ni un protocolo.
10. *¿Dónde va el descriptor de despliegue?* En `WEB-INF/web.xml`, XML declarativo con las definiciones de la aplicación.
