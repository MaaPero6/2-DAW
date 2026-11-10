# Desarrollo web en entorno servidor - Tema 1: Arquitecturas de desarrollo web

## 📌 Resumen Ejecutivo y Objetivos

Antes de escribir una línea de código hay que decidir **dónde se ejecuta cada cosa**. Esta unidad presenta las arquitecturas básicas del desarrollo web, los protocolos que las sostienen y los lenguajes más extendidos, y termina instalando el entorno de trabajo del curso.

El punto de partida es el **modelo cliente-servidor**: un modelo distribuido donde los servidores proveen servicios —información o funcionalidad— y los clientes los consumen. El cliente inicia siempre el proceso con una solicitud; el servidor responde. Ambos se comunican mediante un protocolo que fija el formato de solicitudes y respuestas y suelen ejecutarse en máquinas distintas conectadas por red, aunque pueden convivir en el mismo ordenador.

Sobre esa base se construye la **arquitectura de tres capas** —presentación, negocio y datos—, que desacopla la lógica de negocio de la interfaz para lograr código reutilizable y aplicaciones mantenibles. Después se estudian la generación dinámica (CGI, módulos y servlets), los lenguajes de *scripting* y su integración con las marcas, la evolución de la Web (1.0 a 4.0), las herramientas y el servidor web.

Corresponde al **Resultado de Aprendizaje 1**: «Selecciona las arquitecturas y tecnologías de programación Web en entorno servidor, analizando sus capacidades y características propias».

| Criterio | Enunciado | Apartado |
|---|---|---|
| a | Diferenciar los modelos de ejecución en servidor y cliente | 1.1 |
| b | Ventajas de la generación dinámica frente a los guiones en la página | 1.2 |
| c | Identificar los mecanismos de ejecución de código en servidores web | 1.2 |
| d | Funcionalidades de los servidores de aplicaciones y su integración | 1.2 |
| e | Caracterizar lenguajes y tecnologías del entorno servidor | 1.3 |
| f | Verificar la integración de lenguajes de marcas y programación | 1.3 |
| g | Reconocer y evaluar las herramientas de programación en servidor | 1.5 |

**Objetivos:** justificar en qué capa ubicar cada responsabilidad, explicar el recorrido de una petición, distinguir los mecanismos de ejecución en servidor, clasificar los lenguajes del lado servidor, describir la evolución de la Web, elegir entre editor e IDE y dejar operativo un entorno Apache + PHP + MySQL.

## 📖 Desarrollo Teórico Detallado

### 1.1. Modelo cliente-servidor y arquitectura de tres capas

La comunicación entre clientes y servidores web usa **HTTP** o su versión segura **HTTPS**, con puertos reservados **80** y **443** en la lista de puertos bien conocidos. El protocolo fija el formato de petición y respuesta, lo que permite que cualquier navegador hable con cualquier servidor.

La **arquitectura a tres capas** amplía el modelo separando la lógica de aplicación en tres niveles:

```
   CLIENTE (navegador)          SERVIDOR WEB              SERVIDOR BD
 ┌────────────────────┐      ┌────────────────────┐    ┌──────────────────┐
 │  PRESENTACIÓN      │ HTTP │  NEGOCIO           │SQL │  DATOS           │
 │  HTML, CSS, JS     │─────▶│  PHP, JSP, Python  │───▶│  MySQL, etc.     │
 │  formularios, UI   │◀─────│  reglas de negocio │◀───│  persistencia    │
 └────────────────────┘      └────────────────────┘    └──────────────────┘
        usuario                 lógica de la app          almacenamiento
```

- **Presentación:** interfaz de usuario. Muestra información y permite interactuar. Asume navegabilidad, validación de datos de entrada, formateo de salida, internacionalización y renderizado.
- **Negocio:** lógica propia de la aplicación, resultado del análisis funcional; el conjunto de reglas que abstraen el mundo real. Debe ser independiente de la presentación y viceversa, en lo posible.
- **Datos o persistencia:** inserción, eliminación, actualización y búsqueda de las entidades; no tiene por qué ser una base de datos relacional.

La regla estructural es tajante: **la presentación no se comunica directamente con los datos, sino a través del negocio**. En una aplicación web la presentación corre en el navegador, el negocio en el servidor web y los datos en el servidor de base de datos; estas dos últimas piezas pueden compartir ordenador o estar en equipos distintos.

El objetivo es doble: **desacoplar** negocio y presentación para lograr código reutilizable y, mediante la separación entre componentes, obtener aplicaciones más fáciles de mantener y ampliar.

Esta división se traduce en los perfiles del sector:

| Perfil | Ámbito | Tecnologías | Responsabilidades añadidas |
|---|---|---|---|
| **Front-end** | Cliente | HTML, CSS, JavaScript y frameworks | Diseño y maquetación, presentación en cualquier dispositivo, posicionamiento en buscadores |
| **Back-end** | Servidor | PHP, JSP, Python | Lógica de aplicación, administración del servidor de aplicaciones y de la base de datos |
| **Full stack** | Ambos | El conjunto | No es experto en una tecnología concreta, pero conoce el conjunto y colabora en cualquiera de las partes |

### 1.2. Generación dinámica de páginas y mecanismos de ejecución

Una página escrita solo en **HTML** es **estática**: muestra siempre el mismo contenido. Con un lenguaje de programación en el servidor se generan páginas **en función de la solicitud del cliente**: son las páginas dinámicas. La ventaja decisiva es que el código **nunca viaja al cliente**: el navegador recibe solo el HTML resultante, de modo que la lógica no puede leerse ni alterarse.

Para ejecutar código en un servidor web hay tres vías habituales:

| Mecanismo | Cómo funciona | Implicaciones |
|---|---|---|
| **CGI** (Common Gateway Interface) | Las peticiones se pasan a un **ejecutable** del servidor; ese programa genera la salida y el servidor la entrega al cliente | Un proceso por petición: independiente del servidor pero costoso bajo carga |
| **Módulo del servidor** | El propio servidor incorpora un módulo —generalmente un **intérprete**— que ejecuta el código, sin programa externo | Integración estrecha; es el modelo de PHP en Apache |
| **Servlets** | Objetos Java que reciben una petición y devuelven una respuesta según ella | Exigen un **contenedor web** que interactúa con ellos |

La tercera vía introduce el **servidor de aplicaciones**: la infraestructura que aloja los componentes de negocio y se integra con el servidor web, aportando ciclo de vida, sesiones y despliegue. El servidor web puro tiene como cometido esencial servir contenido.

### 1.3. Lenguajes de scripting e integración con lenguajes de marcas

Un **lenguaje de scripting** (de guiones o embebido) es el que se intercala con el HTML. La idea es crear **plantillas HTML** con instrucciones de programación que el servidor ejecuta para determinar las partes dinámicas. Para ello el servidor necesita un **módulo** (*scripting engine*) capaz de reconocer e interpretar ese lenguaje.

| Lenguaje | Naturaleza | Requisitos / rasgos |
|---|---|---|
| **PHP** | El más extendido del lado servidor | Intérprete integrado en el servidor |
| **JSP** | «La versión Java de PHP» | Necesita un **contenedor web** |
| **ASP.NET** | Alternativa de Microsoft | Integrado en la plataforma **.NET** |
| **PERL** | Especializado en expresiones regulares | Potente en procesamiento de texto |
| **Ruby** | Orientado a objetos | Ecosistema con frameworks propios |

Existe además un amplio catálogo de **frameworks** web que aporta estructura, librerías y metodología.

**Integración con lenguajes de marcas.** Una página dinámica combina una parte estática en HTML y una dinámica en un lenguaje de programación. El proceso es siempre el mismo: el servidor busca **bloques de código**, los ejecuta y **los sustituye por su salida**; el cliente recibe un HTML ya resuelto. En PHP los bloques se delimitan con `<?php ... ?>`:

```php
<!DOCTYPE html>
<html>
<head><title>Número aleatorio</title></head>
<body>
    <?php echo rand(0, 100); ?>
</body>
</html>
```

El servidor ejecuta el bloque y lo reemplaza por un número aleatorio entre 0 y 100. Si sale un 8, el cliente recibe un documento **estático** con un `8` en el cuerpo: jamás ve el `<?php ... ?>`, solo el resultado.

### 1.4. Evolución de la Web: de la Web 1.0 a la Web 4.0

| Versión | Origen | Modelo | Rasgo definitorio |
|---|---|---|---|
| **Web 1.0** | Años 60 con Internet; HTML en los 90 | Solo lectura | Web **estática**; todo depende del *webmaster* |
| **Web 2.0** | Crisis de las «.com»; conferencia de octubre de 2004 | Lectura-escritura | Web **social**: plataforma, inteligencia colectiva, participación |
| **Web 3.0** | Extensión de la Web Semántica (Tim Berners-Lee) | Proactiva | **Semántica**: metadatos y ontologías |
| **Web 4.0** | Término reciente | Ubicua | **Web Total**: IA, voz, unión de inteligencias |

**Web 1.0.** Empezó en los años 60 junto a Internet, con navegadores de solo texto: rápida pero muy simple. En los 90 surgió HTML como lenguaje de hipertexto, que permitió imágenes, formatos y colores. Los primeros navegadores visuales fueron **Netscape** e **Internet Explorer**. Es una web de **solo lectura**: el usuario no puede comentar ni responder, y la información se limita a lo que publique el *webmaster*.

**Web 2.0.** El término nació de una sesión de *brainstorming* entre Dale Dougherty (O'Reilly) y Craig Cline (MediaLive International), que preparaban una conferencia sobre el renacimiento de la Web tras la crisis de las «.com» de 2001. En octubre de 2004 se caracterizó por tres principios: **la web como plataforma**, **la inteligencia colectiva** y **la arquitectura de la participación**. Se basa en comunidades y en redes sociales, blogs y wikis que fomentan la colaboración. Se la llama **Web social** porque el usuario es el ente más importante de la información.

**Web 3.0.** Extensión de la **Web Semántica** de Tim Berners-Lee, enriquece la comunicación con **metadatos semánticos (ontologías)** que dan valor añadido a la información: los contenidos ya no se tratan por su **sintáctica** sino por su **semántica**. Son plataformas que no solo permiten conversación e interacción, sino que **actúan de forma proactiva**. Tiene en cuenta gustos, preferencias, hábitos y contexto, y los dispositivos se conectan en una **red descentralizada** en lugar de depender de servidores con bases de datos, con más seguridad y privacidad. Sus primeros ejemplos son funcionalidades de buscadores apoyadas en IA y *big data*.

**Web 4.0.** Apunta a una **Web Ubicua** que une las inteligencias para que personas y cosas se comuniquen y generen decisiones. Es una web **activa**: un asistente con IA que entiende el lenguaje y ejecuta la tarea —reservar un hotel, comprar una entrada— según gustos y presupuesto. Lo permiten el *big data*, el aprendizaje automático y asistentes como Cortana o Siri.

**Síntesis:** la 1.0 conecta personas con la Web como información estática; la 2.0 conecta personas con personas y sitúa la inteligencia colectiva en el centro (sintáctica); la 3.0 conecta aplicaciones con aplicaciones, mantiene a las personas en el centro y es semántica; la 4.0 conecta personas y aplicaciones de forma ubicua, con IA y voz, para formar una **Web Total**. Como prolongación estética aparece la **web 3D**: CSS3 permite transformaciones en tercera dimensión, HTML5 avanza en ese sentido y **WebGL** es la especificación estándar para gráficos 3D acelerados por hardware.

### 1.5. Herramientas de desarrollo: editores frente a IDE

| Dimensión | Editor de código | IDE |
|---|---|---|
| Peso | Ligero: poca RAM y procesador | Pesado: mucha RAM y CPU potente |
| Unidad de trabajo | Archivos sueltos en una carpeta | **Proyectos completos** |
| Herramientas | Se añaden con **plugins** | Integradas: compilador, emulador, control de versiones, terminal |
| Curva de uso | Inmediata | Mayor; exige configuración |

Que un editor sea ligero no lo hace limitado: admite plugins, por ejemplo para soportar varios lenguajes. Un IDE integra las herramientas y gestiona el proyecto entero.

| Herramienta | Tipo | Licencia | Notas |
|---|---|---|---|
| **NetBeans** | IDE | Gratuito y código abierto | Referencia para PHP: plantillas, autocompletado inteligente, sugerencias, arreglos rápidos y refactorización; compatible con Zend, Doctrine, Smarty y Symfony2 |
| **PHPStorm** | IDE | Muchas utilidades de **pago** | De JetBrains; soporta Symfony, Zend, Yii, CakePHP, Laravel y CMS como Drupal, Magento y WordPress; edición en directo de CSS, HTML5, JavaScript y TypeScript |
| **Eclipse PDT** | IDE | *Open source* | Gran comunidad de plugins; configuración inicial laboriosa y fama de lento, hoy mitigada por el hardware; depuración y validación de PHP |
| **Sublime Text 3** | Editor | Comercial con versión gratuita | Ligero y multiplataforma; su potencia está en los paquetes: xDebug, CodeBug, PHPCS, Simple PHPUnit, PHPDoc |

### 1.6. Servidores web, URL y métodos de petición

El cometido principal de un **servidor web** es servir páginas: proveer contenido a un cliente que lo pide desde un navegador. Carga un archivo y lo sirve por la red, igual en aplicaciones estáticas (HTML) que dinámicas: el servidor es donde se guardan y administran los recursos accesibles.

La petición debe ser **formal**: con unos elementos concretos en un orden determinado. Las direcciones suelen ser **URL** (*Localizador Uniforme de Recurso*), que contienen una dirección, la referencia a un protocolo (HTTP, FTP…) y la ruta al recurso. Opcionalmente incluyen el **puerto** por el que escucha el servidor.

```
protocolo://servidor[:puerto]/ruta/al/recurso
   https  ://  ejemplo.com  :443   /carpeta/pagina.php
```

| Método | Finalidad | Uso típico |
|---|---|---|
| **GET** | Recuperar la información identificada **en la propia URL** | Documentos HTML, imágenes y programas que devuelven su resultado |
| **POST** | **Enviar** información al servidor | Formularios de autenticación, entradas de datos y parámetros de componentes del servidor |

### 1.7. Instalación del entorno de trabajo

**NetBeans:** se descarga la versión de 64 bits para Windows y se instala con el asistente.

**Servidores:** se resuelven con **XAMPP**, que incluye el **servidor web Apache con PHP** y el **servidor de base de datos MySQL**, entre otros componentes; basta con las opciones por defecto y **arrancar los servidores** desde el panel de control.

## 💡 Ejemplos Prácticos y Aplicaciones

### Ejemplo 1: traza de un login a través de las tres capas

1. **Presentación:** el navegador envía un formulario con usuario y contraseña (por **POST**, porque se envían datos).
2. **Negocio:** el servidor recibe la petición y consulta con la base de datos si los datos son correctos. Aquí viven las reglas: ¿existe el usuario?, ¿está activo?
3. **Datos:** la capa de persistencia ejecuta la búsqueda y devuelve el registro.
4. **Retorno:** según la respuesta, negocio pasa las instrucciones a presentación: se permite el acceso o se muestra un error.

Ninguna línea de la comprobación llega al navegador: el cliente solo recibe la bienvenida o el error.

### Ejemplo 2: estático frente a dinámico

| Petición | Documento en disco | Lo que recibe el cliente |
|---|---|---|
| `GET /index.html` | HTML fijo | Siempre el mismo HTML |
| `GET /saludo.php` | Plantilla con `<?php ... ?>` | HTML con el bloque ya sustituido |

La diferencia no está en la URL: en el segundo caso el servidor **procesó** el recurso antes de entregarlo.

### Ejemplo 3: anatomía de una petición

```http
GET /catalogo.php?categoria=libros HTTP/1.1
Host: ejemplo.com
```

El servidor ejecuta `catalogo.php`, consulta la base de datos con el parámetro `categoria` y devuelve HTML. El cliente no sabe qué consulta se ejecutó.

### Ejemplo 4: elegir herramienta y arquitectura

- **Prácticas y proyectos de aprendizaje** → NetBeans: gratuito y con todas las ayudas del IDE.
- **Equipo profesional con presupuesto** → PHPStorm, por su soporte de frameworks y CMS.
- **Máquina modesta o editar un archivo suelto** → Sublime Text 3 con paquetes de PHP.
- **Reglas de negocio complejas** → tres capas estrictas; **página sin datos variables** → HTML estático.

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

### Conceptos clave

1. **Cliente-servidor:** modelo distribuido donde el cliente inicia la solicitud y el servidor provee el servicio.
2. **HTTP / HTTPS:** protocolo web y su versión segura; puertos 80 y 443.
3. **Arquitectura de tres capas:** presentación, negocio y datos; la presentación no accede directamente a los datos.
4. **Desacoplamiento:** separar negocio de presentación para lograr reutilización y mantenibilidad.
5. **Front-end / Back-end / Full stack:** perfiles según el lado en que se trabaja.
6. **Página estática / dinámica:** contenido invariable frente a contenido generado según la solicitud.
7. **CGI:** ejecución de un programa externo al que el servidor pasa la petición.
8. **Módulo del servidor (*scripting engine*):** intérprete integrado en el propio servidor.
9. **Servlet y contenedor web:** objeto Java que atiende peticiones; el contenedor lo gestiona.
10. **Scripting embebido:** código intercalado en plantillas HTML, delimitado por `<?php ... ?>` en PHP.
11. **GET vs POST:** recuperar información identificada en la URL frente a enviar información al servidor.
12. **Web 1.0 / 2.0 / 3.0 / 4.0:** solo lectura, social, semántica y ubicua.

### Preguntas de autoevaluación

**1. ¿Quién inicia la comunicación cliente-servidor y qué implica?**
El cliente. Él envía la solicitud; el servidor no toma la iniciativa, solo responde. Por eso el servidor es reactivo y toda la lógica de una petición depende de lo que el cliente pida.

**2. ¿Por qué la presentación no debe comunicarse directamente con los datos?**
Porque el objetivo es desacoplar la lógica de negocio de la interfaz. Si la vista consultara la base de datos, las reglas quedarían dispersas en la interfaz, el código dejaría de ser reutilizable y cualquier cambio del modelo obligaría a reescribir las vistas.

**3. Enumera las tres capas y una responsabilidad de cada una.**
Presentación: navegabilidad, validación de entrada, formateo de salida y renderizado. Negocio: reglas del dominio, independientes de la presentación. Datos: inserción, eliminación, actualización y búsqueda de entidades, sin que tenga que ser una base de datos relacional.

**4. ¿Qué diferencia hay entre CGI, módulo del servidor y servlet?**
En CGI el servidor delega en un **ejecutable externo** que genera la salida. En el módulo, el propio servidor incorpora un intérprete y ejecuta el código sin programa externo. Los **servlets** son objetos Java que exigen un **contenedor web**. CGI no es hoy la opción más utilizada porque lanza un proceso por petición y penaliza el rendimiento; los módulos integrados y los contenedores lo evitan.

**5. ¿Qué es un lenguaje de scripting en el contexto servidor?**
Aquel que se intercala con el HTML formando plantillas: el servidor localiza los bloques, los ejecuta y los sustituye por su salida. Necesita un *scripting engine* instalado que reconozca el lenguaje.

**6. Explica qué recibe el cliente si la página contiene `<?php echo rand(0,100); ?>` y el sorteo da 8.**
Recibe HTML estático con un `8` en el cuerpo del documento. El bloque PHP se ejecutó y se sustituyó; en el código entregado no queda ninguna marca de servidor.

**7. ¿Qué tres principios definen la Web 2.0 y de dónde surge el término?**
La web como plataforma, la inteligencia colectiva y la arquitectura de la participación. Surgió de un *brainstorming* entre Dale Dougherty y Craig Cline, formalizado en octubre de 2004 al hablar del renacimiento de la Web tras la crisis de las «.com» de 2001.

**8. ¿En qué se diferencia la Web 3.0 de la 2.0?**
La 2.0 es **sintáctica** y colaborativa: los usuarios generan y comparten contenido. La 3.0 es **semántica**: añade metadatos y ontologías para tratar la información por su significado, y las plataformas actúan de forma **proactiva** gracias a la IA y el *big data*.

**9. ¿Cuándo conviene un editor de código y cuándo un IDE?**
El editor, para archivos sueltos, máquinas modestas o inmediatez; sigue siendo potente por sus plugins. El IDE, para un **proyecto completo** con herramientas integradas: compilador, emulador, control de versiones, terminal, depuración y refactorización.

**10. ¿Para qué sirven GET y POST y qué incluye una URL?**
**GET** recupera la información identificada en la propia URL (documentos, imágenes o programas que devuelven su resultado); **POST** envía información al servidor, típicamente en formularios de autenticación y entradas de datos. La **URL** contiene la dirección del servidor, la referencia al protocolo y la ruta al recurso, con el puerto como campo opcional.
