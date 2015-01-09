**Loadxtreme PHP Library**
----------------------
A simple and unofficial PHP library for Loadxtreme loading service. This will allow you to integrate Loadxtreme service to your web application.

Usage:
------

    <?php require_once 'vendor/autoload.php';
    
    use Loadxtreme\Load;
    
    try{
        $load = new Load('123456789', '123456', 'G25X', '09171234567', 'notify@email.com');
        $response = $load->execute();
        
        if ($response['status'] == true) {
	        echo 'Successfully loaded.';
        }
    }catch (Exception $e) {
        echo $e->getMessage();
    }
    #END OF PHP FILE

Parameters
----------
 - **uid** - Your Loadxtreme ID No.
 - **pik** - Your Loadxtreme PIK.
 - **pc** -  A valid Loadxtreme Product Code. Refer to your Product Code Brochure for more info.
 - **cellno** - The cellphone no where you want to send the load.
 - **email** - Your email where you want Loadxtreme to send any notification message.


Response:
--------
When you execute, the library returns an array of response.

    array(3) {
      ["status"]=> true
      ["code"]=> 'SUCCESS'
      ["message"]=> 'Your request has been queued.'
    }

 - **status** - This will be either *true* or *false*. *True* means load has been requested successfully. *False* means there is something wrong with your load request.
 - **code** - This will be either *SUCCESS*, *FAIL*, *REQUEST_ERROR*
 - **message** - This will contain useful request message.

License:
--------

The MIT License (MIT)

Copyright (c) 2015 Omar Usman

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
