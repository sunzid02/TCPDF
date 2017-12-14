  $obj_pdf->Output("sample.pdf", 'D'); -> file will be download as a PDF

................................... doc ..........................................................................

I : send the file inline to the browser (default). The plug-in is used if available. 
    The name given by name is used when one selects the "Save as" option on the link generating the PDF.

D : send to the browser and force a file download with the name given by name.

F : save to a local server file with the name given by name.

S : return the document as a string (name is ignored).

FI : equivalent to F + I option

FD : equivalent to F + D option

E : return the document as base64 mime multi-part email attachment (RFC 2045)