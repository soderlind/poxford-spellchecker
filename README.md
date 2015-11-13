## Project Oxford Spell Check for WordPress TinyMCE

Uses  [Microsoft’s state-of-the-art cloud-based spelling algorithms](https://www.projectoxford.ai/spellcheck) to detect and recognize a wide variety of spelling errors.

<p align="center">
  <img src="https://github.com/soderlind/poxford-spellchecker/blob/master/spellcheck.gif?raw=true" alt="demo" style="border: solid 2px #ccc;" />
</p>

Remember to add your API key to [poxford-spellchecker-rpc.php](poxford-spellchecker-rpc.php#L10). You get the key when you [sign up](https://www.projectoxford.ai/Account/Login?callbackUrl=/Subscription/Index?productId=/products/557a4bd3e597ed1a5886b8d5) at www.projectoxford.ai

poxford-spellchecker-rpc.php [requires HTTP_Request2](https://github.com/soderlind/poxford-spellchecker/blob/master/poxford-spellchecker-rpc.php#L20), install it using `pear install HTTP_Request2` 


This is a proof of concept, it's not without bugs. Feel free to [fork the repository](https://github.com/soderlind/poxford-spellchecker#fork-destination-box) and make it better!
