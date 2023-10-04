<?php //UPDATE COLUMNS TO Tick FROM MATCHES TABLE BEGINS
                                     if(isset($_POST["tick_submit"])){
                                     if(isset($_POST["tick"])){
                                 $sql = "UPDATE matches SET tick='checked' WHERE id = '$_GET[tick_id]'";
                                 $tick_sql = mysqli_query($conn,$sql);
                                         echo '<p>Saved Checked</p>';
                              //   header('Location: my_matches.php');
                      //UPDTE COLUMNS TO EMPTY FROM PROVIDE TABLE ENDS
                                     }else{
                                         $sql = "UPDATE matches SET tick=' ' WHERE id = '$_GET[tick_id]'";
                                 $tick_sql = mysqli_query($conn,$sql);
                                         echo '<p>Unchecked done</p>';
                                     }
                             }
                        ?>