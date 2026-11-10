# UD2 — Introducción a Spring Boot

> **Apuntes** del módulo *Desarrollo Web en Entorno Servidor* (2º DAW).
> Basados en la unidad [UD2: Introducción a Spring Boot](https://majprofe.github.io/dwes/UD2-Introduccion-a-spring-boot.html) de [majprofe.github.io/dwes](https://majprofe.github.io/dwes/).

---

## Índice

1. [¿Qué es Spring Boot?](#1-qué-es-spring-boot)
2. [Ventajas de usar Spring Boot](#2-ventajas-de-usar-spring-boot)
3. [Creación de un proyecto](#3-creación-de-un-proyecto)
   - [3.1 Spring Initializr](#31-spring-initializr)
   - [3.2 Estructura del proyecto](#32-estructura-del-proyecto)
4. [Anatomía de una aplicación](#4-anatomía-de-una-aplicación)
   - [4.1 Ficheros importantes](#41-ficheros-importantes)
   - [4.2 Clase principal](#42-clase-principal)
   - [4.3 `application.properties`](#43-applicationproperties)
5. [Ejecutar la aplicación](#5-ejecutar-la-aplicación)
6. [Ejercicios](#6-ejercicios)
7. [Chuleta rápida](#7-chuleta-rápida)

---

## 1. ¿Qué es Spring Boot?

**Spring Boot** es un framework construido **sobre Spring** que simplifica la creación de aplicaciones Java mediante **configuración automática** y **convenciones preestablecidas**. Permite desarrollar aplicaciones **independientes y listas para producción** con la mínima configuración posible.

> 💡 **Idea clave:** Spring (el framework original) es muy potente pero requiere mucha configuración manual (XML, beans, servidores…). Spring Boot no lo sustituye: lo **envuelve** y automatiza esa configuración para que puedas centrarte en el código de negocio.

**Características principales:**

- Aplicaciones **autocontenidas** (todo lo necesario va dentro del `.jar`).
- **Servidor embebido**: no hace falta desplegar en un Tomcat externo.
- Configuración por **anotaciones y convenciones**, no por XML.
- Ecosistema de *starters*: agrupaciones de dependencias listas para usar.

---

## 2. Ventajas de usar Spring Boot

| Ventaja | Qué significa |
|---|---|
| **Configuración automática** (*Auto-Configuration*) | Spring Boot detecta las dependencias del proyecto y configura los componentes necesarios por ti. |
| **Servidor embebido** | Incluye Tomcat, Jetty o Undertow dentro de la propia aplicación: se ejecuta con un simple `java -jar` o desde el IDE. |
| **Inicio rápido de proyectos** | Con *Spring Initializr* generas un proyecto base funcional en minutos. |
| **Actuadores** (*Actuators*) | Endpoints listos para monitorizar y gestionar la aplicación (estado, métricas, salud…). |
| **Mínima configuración XML** | Se apoya en anotaciones y convenciones; el XML queda prácticamente eliminado. |

---

## 3. Creación de un proyecto

### 3.1 Spring Initializr

Herramienta web que genera un proyecto Spring Boot con las dependencias seleccionadas: **[https://start.spring.io/](https://start.spring.io/)**

**Pasos:**

1. Accede a [start.spring.io](https://start.spring.io/).
2. Configura los metadatos del proyecto:

   | Campo | Valor de ejemplo |
   |---|---|
   | **Project** | Maven Project |
   | **Language** | Java |
   | **Spring Boot** | Versión estable actual |
   | **Group** | `com.ejemplo` |
   | **Artifact** | `demo` |
   | **Name** | `demo` |
   | **Package Name** | `com.ejemplo.demo` |
   | **Packaging** | Jar |
   | **Java Version** | 11 o superior |

3. Añade las dependencias que necesites:

   | Dependencia | Para qué sirve |
   |---|---|
   | **Spring Web** | Construir aplicaciones web y APIs RESTful (incluye el servidor embebido). |
   | **Spring Data JPA** | Acceder a bases de datos mediante JPA/Hibernate. |
   | **Spring Security** | Añadir autenticación y autorización. |
   | **Thymeleaf** | Generar vistas HTML desde el backend. |
   | **H2 Database** | Base de datos en memoria para pruebas rápidas. |

4. **Genera** el proyecto y descarga el `.zip`.
5. **Importa** el proyecto en tu IDE (IntelliJ IDEA, Eclipse, VS Code…).

### 3.2 Estructura del proyecto

Al descomprimir el ZIP obtenemos esta estructura (proyecto Maven):

```text
demo/
├── src/
│   ├── main/
│   │   ├── java/
│   │   │   └── com/
│   │   │       └── ejemplo/
│   │   │           └── demo/
│   │   │               └── DemoApplication.java   ← clase principal
│   │   └── resources/
│   │       ├── application.properties             ← configuración
│   │       ├── static/                            ← CSS, JS, imágenes
│   │       └── templates/                         ← vistas (Thymeleaf)
│   └── test/
│       └── java/
│           └── com/
│               └── ejemplo/
│                   └── demo/
│                       └── DemoApplicationTests.java
├── pom.xml                                        ← dependencias Maven
└── mvnw / mvnw.cmd                                ← Maven Wrapper
```

> 📌 **Convención de paquetes:** el paquete raíz (`com.ejemplo.demo`) es el punto de escaneo de componentes. Todo lo que crees **dentro de él o de sus subpaquetes** será detectado automáticamente por Spring.

---

## 4. Anatomía de una aplicación

### 4.1 Ficheros importantes

| Ruta | Función |
|---|---|
| `pom.xml` (o `build.gradle`) | Gestiona **dependencias** y ciclo de vida del proyecto. Define los *starters* (Spring Web, etc.) y los plugins para compilar y ejecutar. |
| `application.properties` (o `application.yml`) | **Configuración** de la aplicación: puerto, base de datos, logs, etc. |
| `src/main/java` | **Código fuente**: controladores, servicios, repositorios y la clase principal con `@SpringBootApplication`. |
| `src/main/resources` | **Recursos**: plantillas Thymeleaf, estáticos (CSS/JS) y `application.properties`. |
| `src/test/java` | **Pruebas** unitarias y de integración. |

### 4.2 Clase principal

`DemoApplication.java` es el **punto de entrada** de la aplicación:

```java
package com.ejemplo.demo;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication
public class DemoApplication {

    public static void main(String[] args) {
        SpringApplication.run(DemoApplication.class, args);
    }
}
```

**¿Qué hace cada pieza?**

- `@SpringBootApplication` → anotación compuesta que equivale a:
  - `@Configuration` → la clase puede definir *beans*.
  - `@EnableAutoConfiguration` → activa la configuración automática según las dependencias.
  - `@ComponentScan` → escanea el paquete y subpaquetes buscando componentes.
- `SpringApplication.run(...)` → arranca el contexto de Spring, levanta el **servidor embebido** y deja la app escuchando.

### 4.3 `application.properties`

Fichero de configuración de la aplicación. Ejemplo típico:

```properties
# Configuración para el acceso a la Base de Datos
spring.jpa.hibernate.ddl-auto=update
spring.jpa.properties.hibernate.globally_quoted_identifiers=true

# Puerto donde escucha el servidor una vez se inicie
server.port=8081

# Datos de conexión con la base de datos MySQL
spring.datasource.url=jdbc:mysql://localhost:3306/myshoponline
spring.datasource.username=myshopuser
spring.datasource.password=mypassword
spring.datasource.driverClassName=com.mysql.jdbc.Driver
```

**La propiedad `spring.jpa.hibernate.ddl-auto`** controla si Hibernate genera el esquema de la base de datos al arrancar. Solo interesa en **desarrollo**, nunca en producción:

| Valor | Comportamiento |
|---|---|
| `none` | No genera ni modifica la base de datos. |
| `update` | Crea la base de datos si no existe; si existe, **no modifica** los datos existentes. |
| `create` | **Elimina** los datos y vuelve a crear la base de datos en cada arranque. |

> ⚠️ **Ojo con el driver:** `com.mysql.jdbc.Driver` es la clase antigua. En versiones modernas de MySQL Connector/J se usa `com.mysql.cj.jdbc.Driver`. Si da error de *driver not found*, revisa este valor.

> ⚠️ **Seguridad:** no dejes usuario y contraseña en claro en un repositorio. En proyectos reales se usan variables de entorno o perfiles (`application-dev.properties`, `application-prod.properties`).

---

## 5. Ejecutar la aplicación

**Desde el IDE:**

- Ejecutar la clase `DemoApplication.java` (botón *Run*).

**Desde la línea de comandos** (en el directorio del proyecto):

```bash
# Maven
./mvnw spring-boot:run

# Gradle
./gradlew bootRun
```

**Verificación:**

Abre [http://localhost:8080](http://localhost:8080) en el navegador. Verás un **error 404**: es lo normal, porque todavía **no hemos definido ningún controlador** que responda a `/`.

> 💡 Si el 404 aparece, la aplicación **está funcionando**. El 404 lo genera el servidor embebido, no un fallo de arranque.

**Errores comunes al arrancar:**

| Síntoma | Causa probable |
|---|---|
| `Port 8080 was already in use` | Otro proceso usa el puerto → cámbialo con `server.port=...` o mata el proceso. |
| `Communications link failure` | No hay conexión con MySQL o la URL/credenciales son incorrectas. |
| `Failed to configure a DataSource` | Añadiste JPA/MySQL pero no configuraste `spring.datasource.*`. |

---

## 6. Ejercicios

### Ejercicio 1 — ¿Qué es Spring? Módulos principales

Spring es un ecosistema de módulos independientes que se pueden usar por separado:

| Módulo | Descripción |
|---|---|
| **Spring Core / IoC** | Núcleo: inversión de control y **inyección de dependencias** (*beans*). |
| **Spring MVC** | Framework web para construir aplicaciones MVC y APIs REST. |
| **Spring Data** | Abstracción de acceso a datos (JPA, MongoDB, JDBC…). |
| **Spring Security** | Autenticación, autorización y protección de aplicaciones. |
| **Spring AOP** | Programación orientada a aspectos (logs, transacciones, seguridad transversal). |
| **Spring Batch** | Procesamiento por lotes (*batch processing*). |
| **Spring Integration** | Integración de sistemas mediante mensajería. |
| **Spring Cloud** | Patrones para microservicios (configuración, descubrimiento, tolerancia a fallos). |

> Spring Boot no es un módulo más: es la **capa de auto-configuración** que integra todos estos módulos.

### Ejercicio 2 — Banner de inicio personalizado

1. Crea un fichero de texto, por ejemplo `src/main/resources/banner.txt`.
2. Escribe el texto/ASCII que quieras que aparezca al arrancar.
3. Indica su ubicación en `application.properties`:

```properties
spring.banner.location=classpath:banner.txt
```

También puedes desactivarlo con `spring.main.banner-mode=off`.

### Ejercicio 3 — Cambiar el puerto a 9090

Edita `application.properties`:

```properties
server.port=9090
```

Reinicia la aplicación y comprueba que responde en [http://localhost:9090](http://localhost:9090).

### Ejercicio 4 — Controlador simple

Crea `ControladorSaludo` en el paquete `com.ejemplo.demo`:

```java
package com.ejemplo.demo;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class ControladorSaludo {

    @GetMapping("/saludo")
    public String saludo() {
        return "¡Hola, Spring Boot!";
    }
}
```

**Explicación:**

- `@RestController` → marca la clase como controlador web y hace que el valor devuelto se escriba **directamente en el cuerpo de la respuesta** (no busca una vista).
- `@GetMapping("/saludo")` → asocia el método a una petición **HTTP GET** sobre la ruta `/saludo`.

Ejecuta y accede a [http://localhost:9090/saludo](http://localhost:9090/saludo). Deberías ver el texto en el navegador.

---

## 7. Chuleta rápida

```text
CREAR        start.spring.io  →  Maven + Java + Spring Web  →  ZIP  →  importar IDE
ESTRUCTURA   src/main/java (código) · src/main/resources (config/estáticos/plantillas) · pom.xml
ARRANCAR     ./mvnw spring-boot:run        (o ejecutar *Application.java)
CONFIGURAR   application.properties:  server.port=9090
RUTA NUEVA   @RestController + @GetMapping("/ruta")
COMPROBAR    http://localhost:<puerto>/    → 404 = funcionando (aún sin controladores)
```

**Checklist mental antes de dar por buena una práctica:**

- [ ] El proyecto compila (`mvnw clean package`).
- [ ] Arranca sin excepciones en el log.
- [ ] Responde en el puerto configurado.
- [ ] Las rutas definidas devuelven lo esperado.
- [ ] No hay credenciales reales subidas al repositorio.

---

*Apuntes elaborados a partir de la unidad UD2 de [majprofe.github.io/dwes](https://majprofe.github.io/dwes/UD2-Introduccion-a-spring-boot.html).*
