<?php 

////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////MAILER TO CLIENTS//////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// MAILER SEND EMAIL DE CONFEGURACION
            // PROTOCOL OF MAIL MAILER
        
          require_once "../mail.php";
        //   EMAIL  VARIABLE DISTINATION
          $mail->addAddress("matelasluxalgerie@gmail.com");
        //   TITLE OF EMAIL
        $administarteur=$_SESSION['user']->NAME;
          $mail->Subject = 'MATELASLUX::Commande Conferme para'.$administarteur.' Numero: '.$namec.'';
        //   BODY OF  EMAIL 
          $mail->Body = '
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
          <style>
              .center {
                  border: 20px solid #fafa53;
                  display: flex;
                  justify-content: center;
              }
          </style>
      
          <div class="center">
              <div class="card text-dark bg-light mb-3" style="max-width: 80%;">
                  <div class="card-header">Merci '.$namec.' pour de votre inscription chez matelaslux</div>
                  <div class="card-body">
                      <h5 class="card-title">Le plus grand fournisseur en Algérie et la meilleure marque de meubles</h5>
                      <p class="card-text">
      
                          <h2>Information Personnelle</h2>
      
                          <table style="width:100%">
                              <tr>
                                  <td>Nom & Prenom</td>
                                  <td>'.$namec.'</td>
      
                              </tr>
                              <tr>
                                  <td>Adresse</td>
                                  <td>'.$adressec.$codepostalc.'</td>
      
                              </tr>
                              <tr>
                                  <td>Telepjone</td>
                                  <td>'.$telc.'</td>
      
                              </tr>
                              <tr>
                                  <td>Age</td>
                                  <td>'.$agec.'</td>
      
                              </tr>
                              <tr>
                                  <td>Password</td>
                                  <td>'.$passwordc.'</td>
                              </tr>
                              <tr>
                              <td>ESTADO</td>
                              <td>'.$STATUSC.'</td>
                            </tr>
                          </table>
                          <p dir="rtl"> أكبر مورد في الجزائر وأفضل علامة مفروشات , ماكلالوكس علامة مسجلة و جميع الحقوق محفوظة </p>
                          <a href="https://www.matelaslux.com" target="_blank">Matealslux.com </a> &nbsp;
                          <a href="tel:+213550693200">Service Client</a>
                          <a dir="rtl" href="#">الغاء الاشتراك</a>
          ';
        // SET FROM 
          $mail->setFrom("NoRaply@elbossinmobiliaria.es", "MATELASLUX:NEWUSER");
          $mail->send();
            
    
///////////////////////////////////END//////////////////////////////////////////////////

?>