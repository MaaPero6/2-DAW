# Node.js, Express, React y Angular — Resumen

Apuntes rápidos para **Desarrollo Web en Entorno Cliente (DWEC)**.

---

## 1. Node.js

**Qué es:** un entorno que permite ejecutar JavaScript fuera del navegador, en el servidor o en tu propio ordenador. Usa el motor V8 de Chrome.

**Cómo funciona:**
- Un solo hilo con *event loop*: en vez de crear un hilo por cada petición, gestiona muchas operaciones a la vez de forma **asíncrona y no bloqueante**.
- Ideal para aplicaciones con muchas conexiones simultáneas (APIs, chats, etc.).

**Piezas clave:**
- **npm**: el gestor de paquetes. Con `npm install` añades librerías a tu proyecto.
- **Módulos**: organizas el código en ficheros que se importan/exportan.
- **package.json**: el fichero que describe tu proyecto y sus dependencias.

**En DWEC para qué lo veréis:** sobre todo como herramienta (instalar dependencias, lanzar el servidor de desarrollo con Vite o similar) y para entender el lado servidor con el que habla vuestro frontend.

---

## 2. Express

**Qué es:** un framework minimalista para Node.js, lo más usado para crear servidores web y APIs.

**Ideas clave:**
- **Rutas:** defines qué responder según el método y la URL. Ejemplo mental: `app.get('/api/productos', ...)` devuelve la lista de productos en JSON.
- **Middlewares:** funciones que se ejecutan en cadena con cada petición (para logs, autenticación, parsear JSON, gestionar errores...).
- **req / res:** objetos de petición y respuesta con los que trabajas en cada ruta.

**En DWEC para qué lo veréis:** para montar la API (real o de prueba) que luego consumirá vuestra aplicación de cliente con `fetch`.

---

## 3. React

**Qué es:** una **librería** (no un framework completo) creada por Meta para construir interfaces de usuario.

**Ideas clave:**
- **Componentes:** la UI se divide en piezas reutilizables (un botón, una tarjeta de producto, una lista...).
- **JSX:** escribes HTML dentro de JavaScript, lo que hace los componentes muy legibles.
- **Props y state:** las props son datos que recibe un componente; el state son sus datos internos. Cuando el state cambia, React vuelve a pintar.
- **Virtual DOM:** React calcula qué ha cambiado y actualiza solo esa parte del DOM real. Por eso es rápido.
- **Hooks:** funciones como `useState` o `useEffect` para manejar estado y efectos en componentes funcionales.
- **Flujo unidireccional:** los datos bajan de padres a hijos.

**Ecosistema típico:** React Router (navegación), herramientas de build como Vite.

**En DWEC para qué lo veréis:** para construir SPAs (aplicaciones de una sola página) reactivas, donde la página no se recarga entera.

---

## 4. Angular

**Qué es:** un **framework completo** de Google para aplicaciones web, basado en **TypeScript** (JavaScript con tipos).

**Ideas clave:**
- **Componentes + módulos:** la app se organiza en componentes (lógica + plantilla + estilos) agrupados en módulos.
- **Plantillas con binding:** sintaxis como `{{ dato }}`, `[propiedad]="valor"` y `(evento)="metodo()"` para conectar la vista con la lógica.
- **Inyección de dependencias y servicios:** la lógica compartida (p. ej. llamadas HTTP) vive en servicios que se inyectan donde hacen falta.
- **RxJS / Observables:** para manejar datos asíncronos (peticiones HTTP, eventos) de forma potente.
- **Angular CLI:** herramienta de línea de comandos para crear el proyecto, componentes, servicios y compilar.

**Diferencia con React:** Angular es más "opinativo", trae de serie router, cliente HTTP, formularios y estructura de proyecto marcada. React es más libre y tú eliges las piezas.

**En DWEC para qué lo veréis:** para SPAs grandes y estructuradas, con arquitectura clara desde el principio.

---

## Comparativa rápida

|  | Node.js | Express | React | Angular |
|---|---|---|---|---|
| **Tipo** | Runtime de JS | Framework backend | Librería de UI | Framework frontend |
| **Lenguaje** | JavaScript | JavaScript | JavaScript + JSX | TypeScript |
| **Corre en** | Servidor / tu PC | Sobre Node.js | Navegador | Navegador |
| **Uso típico** | Servidores, tooling | APIs REST | SPAs, componentes | SPAs empresariales |
| **Curva de aprendizaje** | Media | Baja | Media | Alta |

---

## Cómo encajan entre sí

```
┌─────────────┐      fetch/HTTP      ┌──────────────────┐
│  FRONTEND   │  ─────────────────▶  │     BACKEND      │
│ React o     │  ◀─────────────────  │ Node.js +        │
│ Angular     │      JSON            │ Express (API)    │
└─────────────┘                      └──────────────────┘
```

- **Node.js + Express** = el backend que sirve datos (la API).
- **React o Angular** = el frontend que pide esos datos y los muestra sin recargar la página.
- En clase probablemente montaréis una API sencilla con Express y un cliente con React o Angular que la consuma.
