<!DOCTYPE html>
<html>
<head>
    <title>Inspection Report</title>
    <style>
        /* Add your custom styles for the PDF */
    </style>
</head>
<body>
<!-- page start -->
<!-- page start-->
<div class="ks_box">
   <div class="equipment_registration">
      <div class="mainTitle">
         <h3 style="font-size:18px;text-align: center;font-weight: normal;clear:both">
            <span style="text-align: left;font-weight: normal;border-bottom: 0.09em solid;clear:both;">INFINIGUARD® QR Number {{ $qr_number }} Maintenance History Report</span>
         </h3>  
      </div>
      <div class="egu_reg">
         <h3 style="font-size:18px;text-align: left;font-weight: normal;clear:both;">
            <span style="text-align: left;font-weight: normal;border-bottom: 0.09em solid;clear:both;">INFINIGUARD® - Equipment Registration</span>
         </h3>        
         <div style="width:100%;margin-top:25px;margin-bottom:30px;">
            <table cellpadding="0" cellspacing="0" style="border-spacing: 0 !important;border: 1px solid;">
               <tr>
                  <td width="80%">
                     <table cellpadding="0" cellspacing="0" style="width:100%;float:left;">
                        <tr>
                           <td style="border-bottom: 1px solid;border-right: 1px solid;padding:10px;vertical-align: middle;text-align: left;"><span style="font-size:16px;font-weight:bold;">Date :</span></td>
                           <td style="border-bottom: 1px solid;border-right: 1px solid;padding:10px;vertical-align: middle;text-align: left;">
                              <span style="font-size:16px;">
                                 {{ $formattedData[0]['date'] }}
                              </span>
                           </td>
                        </tr>
                         <tr>
                                <td style="border-bottom: 1px solid;border-right: 1px solid;padding:10px;vertical-align: middle;text-align: left;"><span style="font-size:16px;font-weight:bold;">Time :</th>
                                <td style="border-bottom: 1px solid;border-right: 1px solid;padding:10px;vertical-align: middle;text-align: left;">
                                 <span style="font-size:16px;">{{ $formattedData[0]['time'] }}</span></th>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid;border-right: 1px solid;padding:10px;vertical-align: middle;text-align: left;"><span style="font-size:16px;font-weight:bold;">Location :</th>
                                <td style="border-bottom: 1px solid;border-right: 1px solid;padding:10px;vertical-align: middle;text-align: left;">
                                 <span style="font-size:16px;">{{ $formattedData[0]['inspection_address'] }}</span></th>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid;border-right: 1px solid;padding:10px;vertical-align: middle;text-align: left;"><span style="font-size:16px;font-weight:bold;">Certified Applicator<br />Certification ID:</th>
                                <td style="border-bottom: 1px solid;border-right: 1px solid;padding:10px;vertical-align: middle;text-align: left;">
                                 <span style="font-size:16px;">{{ $certification_id ?? "" }}</span></th>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid;border-right: 1px solid;padding:10px;vertical-align: middle;text-align: left;"><span style="font-size:16px;font-weight:bold;">Notes :</th>
                                <td style="border-bottom: 1px solid;border-right: 1px solid;padding:10px;vertical-align: middle;text-align: left;">
                                 <span style="font-size:16px;">{{ $formattedData[0]['notes'] }}</span></td>
                            </tr>     
                       
                     </table>
                  </td>
                  <!-- More cells -->
               </tr>
            </table>
         </div>
      </div>
      <div class="">
         <h3 style="font-size:18px;text-align: left;font-weight: normal;clear:both;">
            <span style="text-align: left;font-weight: normal;border-bottom: 0.09em solid;clear:both;">INFINIGUARD® - Maintenance Registration</span>
         </h3>
         <div style="width:100%;margin-top:25px;">        
            <table style="border-collapse: collapse; width: 100%;">
               <tr>
                    <th style="border: 1px solid; padding: 10px;width: 15%">Date</th>
                    <th style="border: 1px solid; padding: 10px;width: 15%">Time</th>
                    <th style="border: 1px solid; padding: 10px;width: 15%">Location</th>
                    <th style="border: 1px solid; padding: 10px;width: 15%">Warranty Claim (YES/NO)</th>
               </tr>               
                @foreach($formattedData as $data)   
                    @php
                        if($data['type'] == 'Registration'){
                            continue;
                        }                         
                    @endphp                    
                    <tr>
                        <td style="border: 1px solid; padding: 10px;">{{ $data['date'] }}</td>
                        <td style="border: 1px solid; padding: 10px;">{{ $data['time'] }}</td>
                        <td style="border: 1px solid; padding: 10px;">{{ $data['inspection_address'] }}</td>
                        <td style="border: 1px solid; padding: 10px;">{{ $data['warrantyClaim']}}</td>
                    </tr>
                @endforeach
            </table>
         </div>
      </div>
   </div>
</div>

</body>
</html>



