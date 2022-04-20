<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>

  <form action="/action_page.php">
    <label for="email_address">Email Address</label>
    <input type="text" id="email_address" name="email_address" placeholder="Your Email Address..">

    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Your Name..">

     <label for="subject">Subject</label>
    <input type="text" id="subject" name="subject" placeholder="Your Subject..">

    <label for="message">Message</label>
    <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>

    <button type="button" class="btn btn-info" id="email_send">Save</button>
  </form>