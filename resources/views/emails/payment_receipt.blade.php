@extends('emails.layout.emailLayout')

@section('content')

<table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
  <tr>
    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
      <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi {{ $transaction->client->onames }},</p>
      <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Your transaction details are as follows:</p>
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
        <tbody>
          <tr>
            <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                <tbody>
                  <tr>
                    <td style="padding: 5px 15px"> 
                      <strong>Transaction number:</strong>
                    </td>
                    <td style="padding: 5px 15px"> 
                      {{ $transaction->transaction_number  }}
                    </td>
                  </tr>
                  <tr>
                    <td style="padding: 5px 15px"> 
                      <strong>Estate:</strong>
                    </td>
                    <td style="padding: 5px 15px"> 
                      {{ $transaction->property->estatePropertyType->estate->name  }}
                    </td>
                  </tr>
                  <tr>
                    <td style="padding: 5px 15px"> 
                      <strong>Property:</strong>
                    </td>
                    <td style="padding: 5px 15px"> 
                      {{ $transaction->property->estatePropertyType->propertyType->name  }}
                    </td>
                    <tr>
                      <td style="padding: 5px 15px"> 
                        <strong>Property number:</strong>
                      </td>
                      <td style="padding: 5px 15px"> 
                        {{ $transaction->property->unique_number  }}
                      </td>
                    </tr>
                    <tr>
                      <td style="padding: 5px 15px"> 
                        <strong>Amount:</strong>
                      </td>
                      <td style="padding: 5px 15px"> 
                        &#x20A6; {{ number_format($transaction->amount, 2)  }}
                      </td>
                    </tr>
                    <tr>
                      <td style="padding: 5px 15px"> 
                        <strong>Date:</strong>
                      </td>
                      <td style="padding: 5px 15px"> 
                        {{ $transaction->created_at->toFormattedDateString()  }}
                      </td>
                    </tr>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
      <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">A copy of your transaction receipt is also attached to this email</p>
    </td>
  </tr>
</table>

@endsection