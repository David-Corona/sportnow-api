# SportNow

## ¿Qué es SportNow?

Aplicación web que ofrece los medios para que las personas encuentren compañeros con los que realizar todo tipo de actividades deportivas.

### Objetivos
- Sistema autenticación: registro, login, logout y reseteo contraseña.
- Actividades: listado con filtros, ver y apuntarse a actividades existentes y crear nuevas.
- Ver detalles de las actividades, sus participantes y permitir comunicación entre participantes.
- Ver perfiles de usuarios y permitir editar el propio.
- Panel de administración accesible solo para administradores que permita gestionar cómodamente la información de la base de datos
(listar, crear, ver, editar y eliminar).
- Página principal con noticias, novedades, publicidad, etc.
- Página de contacto e información de la empresa.

<br/>

## Tecnologías
<br/>

![image](https://user-images.githubusercontent.com/78616188/219038419-ea07bd38-04fe-40b3-8720-517dd40cffc0.png)


## Base de Datos - Modelo Entidad-Relación
<br/>

![image](https://user-images.githubusercontent.com/78616188/219036473-2ae851dd-dee9-4a39-972b-313a28fb5545.png)

<br/>

## Instalación

Clona el repositorio:
```
git clone https://github.com/David-Corona/sportnow-api.git
```

Instala las dependencias con Composer:
```
composer install
```

Genera la key de la aplicación:
```
php artisan key:generate
```

Genera el token de autentificación JWT:
```
php artisan jwt:generate
```

Ejecuta las migraciones y el seeding:
```
php artisan migrate --seed
```

Arranca el servidor local:
```
php artisan serve
```

Comprueba el funcionamiento accediendo a: http://localhost:8000

<br/>

## Enlaces
- **[Presentación PFC](https://drive.google.com/file/d/1PRxfA1Ih4-7lXyRUETKM1--IYLSGZLSF/view)**
- **[Memoria PFC](https://drive.google.com/file/d/17Tz1aQ-CFSswy-JqPMiMCDig2d2gDtaB/view)**
- **[Video demo](https://drive.google.com/file/d/1JahyjKhTQMm5DjaDTe66TQ7dgWXmGkXy/view)**

