<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>proyecto-04-maquetacion</title>
  </head>
  <body>
    
    <nav>
      
    </nav>

    <header>
      <h1>(h1) Panadería en bilbao</h1>
    </header>

    <main>

            <!-- contacto -->
      <section>
        <h2>(h2) Contacto</h2>
        
        <article class="artForm01" id="form">

          <?php
          // comprobar si hay variables get en la URL
          // si hay variables las voy a recoger aquí
          // si recojo variables, las usaré en el formulario para mostrar mensajes, por ejemplo de error, por ejemplo losvalorfes que el user había puesto antes en el formulario
          // Recoger el error si existe error, y mostrar el mensaje con el error
          // Depende del error, lo mostraremos encima del input donde está el error
          // Como recogemos los value de los input que el user mandó al backend, volvemos a rellenar los values de los input con esos valores, para que se respete el UX

          if(isset($_GET['error'])){
            $error = $_GET['error'];
            $campo = $_GET['campo'];
            $nombre = $_GET['nombre'];
            $telefono = $_GET['tel'];
            $email = $_GET['email'];
            $mensaje = $_GET['mensaje'];
          }

          ?>

          <h3>(h3) formulario y datos</h3>
          <div>
            <div class="contenedor-form">
              <img src="./src/resources/mail.svg" alt="">
              <?php
              if(!isset($_GET['envio'])){              
              ?>
              <form action="/App/artForm01.php" method="post" id="idForm">

                <?php
                if(isset($error)){   
                ?>
                  <p class="error">Hay un error en el campo <?=$campo?> de tipo <?= $error?></p>
                <?php
                }
                ?>

                <!-- nombre -->
                <label for="nombre">Nombre *</label>
                <input type="text" id="nombre" name="nombre" placeholder="Escribe aquí tu nombre *" value="<?php if(isset($error)){echo $nombre;}?>">

                <!-- teléfono -->
                <label for="telefono">Teléfono *</label>
                <input type="tel" id="telefono" name="telefono" placeholder="Escribe aquí tu teléfono *" value="<?php if(isset($error)){echo $telefono;}?>">

                <!-- Correo -->
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Escribe aquí tu correo electrónico" value="<?php if(isset($error)){echo $email;}?>">

                <!-- Mensaje -->
                <label for="mensaje">Escribe tu mensaje</label>
                <textarea name="mensaje" id="mensaje" placeholder="Escribe aquí tu mensaje"><?php if(isset($error)){echo $mensaje;}?></textarea>

                <!-- términos -->
                <div class="horizontal">
                  <label for="terminos">Aceptar términos y condiciones de privacidad</label>
                  <input type="checkbox" name="terminos" id="terminos">
                </div>
                

                <!-- captcha -->
                <label for="respuesta">Resuelve</label>
                <div class="horizontal">
                  <span id="num1">3</span>
                  <span id="operador">+</span>
                  <span id="num2">7</span>
                  <input type="text" name="respUser" id="respuesta" placeholder="Respuesta" autocomplete="off">
                  <input type="hidden" name="respSystem" id="respSystem" value="">
                </div>

                <input type="submit" class="boton" value="Enviar">
              </form>
              <?php
              }else{
                $nombre=$_GET['nombre'];
              ?>
              <h3>Gracias, hemos recibido tu consulta <?= $nombre ?></h3>
              <?php
              }
              ?>

            </div>
            <div class="contenedor-info">
              <ul>
                <li>
                  <a href="tel:+34943123123" target="_blank">
                    <img src="./src/resources/tel.svg" alt="" title="">
                    <span>943 123 123</span>
                  </a>
                </li>
                <li>
                  <a href="mailto:aranaz@webda.eus" target="_blank">
                    <img src="./src/resources/mail.svg" alt="" title="">
                    <span>aranaz@webda.eus</span>
                  </a>
                </li>
                <li>
                  <a href="https://wa.me/628749350" target="_blank">
                    <img src="./src/resources/wa.svg" alt="" title="">
                    <span>628 749 350</span>
                  </a>
                </li>
                <li>
                  <a href="https://maps.app.goo.gl/Kh7rZM3WF1chSZSj7" target="_blank">
                    <img src="./src/resources/map.svg" alt="" title="">
                    <span>C/ Juan Fermín, Juan F. Gilisagasti Kalea, 4, 1º, 20018 Donostia / San Sebastián, Gipuzkoa</span>
                  </a>
                </li>
              </ul>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1886.901188915529!2d-2.0047191655624914!3d43.29790730427824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd51b013f0513629%3A0x57e4ff3311f619d9!2s%C3%81rea%20Escuela%20de%20Dise%C3%B1o%20y%20Nuevas%20Tecnolog%C3%ADas!5e1!3m2!1ses!2ses!4v1768584957042!5m2!1ses!2ses" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </article>

      </section>

      <!-- quienes somos -->
      <section>

        <h2>(h2) Quienes Somos</h2>

        <!-- nuestra panadería -->
        <article class="art01">
          <h3>(h3) Nuestra panadería</h3>

          <img
          srcset="
          https://dummyimage.com/900x900 900w,
          https://dummyimage.com/1800x1100 1800w,
          https://dummyimage.com/2560x1200 2560w
          "
          sizes="
          (width <= 900px) 800px,
          (width <= 1500px) 1200px,
          2560px
          "
          src="https://dummyimage.com/900x900"
          width="900"
          alt="" 
          title="">

          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum voluptatum natus ea veritatis harum qui eaque atque exercitationem laudantium? Inventore illum explicabo vero error laborum beatae atque eligendi fugit possimus repudiandae, dolor cupiditate itaque tempore! Et maxime, laboriosam consectetur, similique sunt corporis eum eveniet officia rerum ducimus molestias dolorum libero.</p>

          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas pariatur necessitatibus optio inventore esse ipsum ad eveniet sequi iusto distinctio enim assumenda nostrum explicabo facere quo numquam, quod eius hic.</p>

          <a href="" class="boton">CTA</a>

        </article>

        <!-- nuestra gente -->
        <article class="art05">
          <h3>(h3) Nuestra gente</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas accusamus tenetur et fuga illum corporis doloribus. Illum, autem distinctio sed consectetur illo placeat nobis esse perferendis molestiae, explicabo voluptates quod ducimus tenetur voluptatum? Minus illo eveniet aliquam exercitationem libero repellat aliquid</p>
          <div>
            <div class="ficha">
              <img src="https://dummyimage.com/300x300" alt="" title="">
              <div>
                <h4>Encabezado h4</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, iure!</p>
                <p>Lorem, ipsum.</p>
              </div>
            </div>

            <div class="ficha">
              <img src="https://dummyimage.com/300x300" alt="" title="">
              <div>
                <h4>Encabezado h4</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, iure! Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur, aliquid?</p>
                <p>Lorem, ipsum.</p>
              </div>
            </div>

            <div class="ficha">
              <img src="https://dummyimage.com/300x300" alt="" title="">
              <div>
                <h4>Encabezado h4</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, iure!</p>
                <p>Lorem, ipsum.</p>
              </div>
            </div>

            <div class="ficha">
              <img src="https://dummyimage.com/300x300" alt="" title="">
              <div>
                <h4>Encabezado h4</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p>Lorem, ipsum.</p>
              </div>
            </div>
          </div>
        </article>

        <!-- nuestros valores -->
        <article class="art02">

          <h3>Nuestros valores</h3>

          <div>

            <div class="contenedor-lista">
              <h4>Atención personalizada</h4>
              <ul>
                <li>
                  <img src="./src/resources/checkmark-circle.svg" alt="" title="">
                  <span>Lorem ipsum dolor sit amet.</span>
                </li>
                <li>
                  <img src="./src/resources/checkmark-circle.svg" alt="" title="">
                  <span>Lorem ipsum dolor sit amet.</span>
                </li>
                <li>
                  <img src="./src/resources/checkmark-circle.svg" alt="" title="">
                  <span>Lorem ipsum dolor sit amet.</span>
                </li>
                <li>
                  <img src="./src/resources/checkmark-circle.svg" alt="" title="">
                  <span>Lorem ipsum dolor sit amet.</span>
                </li>
                <li>
                  <img src="./src/resources/checkmark-circle.svg" alt="" title="">
                  <span>Lorem ipsum dolor sit amet.</span>
                </li>
              </ul>
            </div>

            <div class="contenedor-lista">
              <h4>Los mejores ingredientes</h4>
              <ul>
                <li>
                  <img src="./src/resources/checkmark-circle.svg" alt="" title="">
                  <span>Lorem ipsum dolor sit amet.</span>
                </li>
                <li>
                  <img src="./src/resources/checkmark-circle.svg" alt="" title="">
                  <span>Lorem ipsum dolor sit amet.</span>
                </li>
                <li>
                  <img src="./src/resources/checkmark-circle.svg" alt="" title="">
                  <span>Lorem ipsum dolor sit amet.</span>
                </li>
                <li>
                  <img src="./src/resources/checkmark-circle.svg" alt="" title="">
                  <span>Lorem ipsum dolor sit amet.</span>
                </li>
                <li>
                  <img src="./src/resources/checkmark-circle.svg" alt="" title="">
                  <span>Lorem ipsum dolor sit amet.</span>
                </li>
              </ul>
            </div>

          </div>

        </article>

        

      </section>

      <!-- productos -->
      <section>

        <h2>(h2) Nuestros productos</h2>
        
        <!-- grid de imágenes de todos los productos -->
        <article class="art04">

          <div>
            <img src="https://dummyimage.com/900x900" alt="">
          </div>

          <div>
            <img src="https://dummyimage.com/900x900" alt="">
          </div>

          <div>
            <img src="https://dummyimage.com/900x900" alt="">
          </div>

          <div>
            <img src="https://dummyimage.com/900x900" alt="">
          </div>

          <div>
            <img src="https://dummyimage.com/900x900" alt="">
          </div>

          <div>
            <img src="https://dummyimage.com/900x900" alt="">
          </div>

          <div>
            <img src="https://dummyimage.com/900x900" alt="">
          </div>

          <div>
            <img src="https://dummyimage.com/900x900" alt="">
          </div>

        </article>

        <!-- beneficios de los ingredientes -->
        <article class="art03">
          <h3>Encabezado h3</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus ipsum libero saepe voluptatem unde sequi quas corporis quibusdam debitis odit ea, asperiores facere ullam ab dolores perspiciatis sapiente aliquid officia nisi corrupti voluptatibus provident laboriosam similique deleniti. Consequuntur, explicabo id amet corrupti at reiciendis, ullam eaque asperiores est officiis sint?</p>
          <div>
            <div class="ficha">
              <img src="https://dummyimage.com/50x50" alt="">
              <h4>Encabezado h4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt totam excepturi officia ipsam aut illo recusandae placeat, neque ut inventore.</p>
            </div>
            <div class="ficha">
              <img src="https://dummyimage.com/50x50" alt="">
              <h4>Encabezado h4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt totam excepturi officia ipsam aut illo recusandae placeat, neque ut inventore.</p>
            </div>
            <div class="ficha">
              <img src="https://dummyimage.com/50x50" alt="">
              <h4>Encabezado h4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt totam excepturi officia ipsam aut illo recusandae placeat, neque ut inventore.</p>
            </div>
            <div class="ficha">
              <img src="https://dummyimage.com/50x50" alt="">
              <h4>Encabezado h4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt totam excepturi officia ipsam aut illo recusandae placeat, neque ut inventore.</p>
            </div>
            <div class="ficha">
              <img src="https://dummyimage.com/50x50" alt="">
              <h4>Encabezado h4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt totam excepturi officia ipsam aut illo recusandae placeat, neque ut inventore.</p>
            </div>
            <div class="ficha">
              <img src="https://dummyimage.com/50x50" alt="">
              <h4>Encabezado h4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt totam excepturi officia ipsam aut illo recusandae placeat, neque ut inventore.</p>
            </div>
            <div class="ficha">
              <img src="https://dummyimage.com/50x50" alt="">
              <h4>Encabezado h4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt totam excepturi officia ipsam aut illo recusandae placeat, neque ut inventore.</p>
            </div>
            <div class="ficha">
              <img src="https://dummyimage.com/50x50" alt="">
              <h4>Encabezado h4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt totam excepturi officia ipsam aut illo recusandae placeat, neque ut inventore.</p>
            </div>
            <div class="ficha">
              <img src="https://dummyimage.com/50x50" alt="">
              <h4>Encabezado h4</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt totam excepturi officia ipsam aut illo recusandae placeat, neque ut inventore.</p>
            </div>
          </div>
        </article>

        <!-- panaderia -->
        <article class="art06">
          <img
            alt="" 
            title=""
            srcset="
            https://dummyimage.com/1500x900 1500w,
            https://dummyimage.com/1100x700 1100w
            "
            sizes="
            (max-width:800px) 900px,
            1500px
            "
            src="https://dummyimage.com/1200x900"          
          >
          <div>
            <h3>Panadería</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe et harum exercitationem nihil quam repellat itaque maiores inventore, nulla earum cumque, optio quibusdam repudiandae nesciunt aliquam? Nisi nam asperiores optio omnis eaque blanditiis totam iusto, magnam enim tenetur soluta quo nemo? Libero voluptatum ullam labore doloribus eius veritatis corrupti in.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ullam quam delectus error quis nihil fugiat cupiditate officiis esse, dicta praesentium illo ducimus. Dolorum adipisci, nesciunt expedita non officia ratione, saepe soluta nihil eius odit neque eaque vitae illo deserunt.</p>
            <a href="#" class="boton">CTA</a>
          </div>
        </article>

        <!-- pastelería -->
        <article class="art06 upsidedown">
          <img
            alt="" 
            title=""
            srcset="
            https://dummyimage.com/1500x900 1500w,
            https://dummyimage.com/1100x700 1100w
            "
            sizes="
            (max-width:800px) 900px,
            1500px
            "
            src="https://dummyimage.com/1200x900"          
          >
          <div>
            <h3>Pastelería</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe et harum exercitationem nihil quam repellat itaque maiores inventore, nulla earum cumque, optio quibusdam repudiandae nesciunt aliquam? Nisi nam asperiores optio omnis eaque blanditiis totam iusto, magnam enim tenetur soluta quo nemo? Libero voluptatum ullam labore doloribus eius veritatis corrupti in.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ullam quam delectus error quis nihil fugiat cupiditate officiis esse, dicta praesentium illo ducimus. Dolorum adipisci, nesciunt expedita non officia ratione, saepe soluta nihil eius odit neque eaque vitae illo deserunt.</p>
            <a href="#" class="boton">CTA</a>
          </div>
        </article>

        <!-- torrijas -->
        <article class="art06">
          <img
            alt="" 
            title=""
            srcset="
            https://dummyimage.com/1500x900 1500w,
            https://dummyimage.com/1100x700 1100w
            "
            sizes="
            (max-width:800px) 900px,
            1500px
            "
            src="https://dummyimage.com/1200x900"          
          >
          <div>
            <h3>Torrijas</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe et harum exercitationem nihil quam repellat itaque maiores inventore, nulla earum cumque, optio quibusdam repudiandae nesciunt aliquam? Nisi nam asperiores optio omnis eaque blanditiis totam iusto, magnam enim tenetur soluta quo nemo? Libero voluptatum ullam labore doloribus eius veritatis corrupti in.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui ullam quam delectus error quis nihil fugiat cupiditate officiis esse, dicta praesentium illo ducimus. Dolorum adipisci, nesciunt expedita non officia ratione, saepe soluta nihil eius odit neque eaque vitae illo deserunt.</p>
            <a href="#" class="boton">CTA</a>
          </div>
        </article>

      </section>
      

    </main>

    <footer>

    </footer>


    


    <script type="module" src="/src/main.js"></script>
  </body>
</html>
