<form method="post" action="https://sbcheckout.payfort.com/FortAPI/paymentPage" id="form1">

  <input type="hidden" name="service_command" value="TOKENIZATION" />
  <input type="hidden" name="language" value="en" />
  <input type="hidden" name="merchant_identifier" value="0b62e9c1" />
  <input type="hidden" name="access_code" value="bUOVKlJHpxjbE0stidlS" />
  <input type="hidden" name="signature" id="signature" />
  <input type="hidden" name="currency" id="currency" value="SAR"/>
  <input id="merchant_reference" type="text" name="merchant_reference" placeholder="Merchant Reference(Unique)" required/><br><br>
  <input id="amount" type="number" name="amount" min="50" placeholder="Amount" required /><br><br>
  <button type="submit" style="color:red">Submit</button>

</form>

<script>
	
  /**
   * Event listner to listen for form submit
   * Listen the event, prevent the form from submitting and set the value of signature
   *
   * @return void
  */
  document.getElementById("form1").addEventListener('submit', function(e){
    e.preventDefault();
    setSignature();
  });
  
  /**
   * Make the request to backend for genaration of signature
   * Set the signature value in the input
   *
   * @return void
  */
  function setSignature() {
	let merchant_reference = document.getElementById("merchant_reference").value;
    let amount = document.getElementById("amount").value;
    let currency = document.getElementById("currency").value;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       	document.getElementById("signature").value = xhttp.responseText;
        document.getElementById("form1").submit();
       }
    };
    
    xhttp.open("GET",
       "/printplus/payfort/requestSignature?merchant_reference="+merchant_reference+"&amount="+amount+"&currency="+currency,
       false
    );
    xhttp.send();
  }
 
</script>
