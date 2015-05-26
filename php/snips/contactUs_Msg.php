<?php
//var_dump($_POST);
if($isLive){
    $loc = "/index.php?p=c1";
}else{
    $loc = "$dynaUrl/index.php?p=c1";
}
if(isset($_POST['btnContactUs'])){
    require 'php/pscript/processContactUsMsg.php';    
}else{
?>
<form method="post" name="contactUsForm" action="<?php echo $loc ?>">                
    <div id="nameBlk" class="mtcu col-sm-5">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required="required" />
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                </span>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required" /></div>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <select id="subject" name="subject" class="form-control" required="required">
                <option value="na" selected="">Choose One:</option>
                <option value="service">General Customer Service</option>
                <option value="suggestions">Suggestions</option>
                <option value="product">Product Support</option>
            </select>
        </div>
    </div>
    <div id="msgBlk" class="mtcu col-sm-7">
        <div class="form-group">
            <label for="name">Message</label>
            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required" placeholder="Message"></textarea>
        </div>
        <button type="submit" class="btn btn-primary pull-right" name="btnContactUs" id="btnContactUs">Send Message</button>
    </div> 
</form>
<?php
}
