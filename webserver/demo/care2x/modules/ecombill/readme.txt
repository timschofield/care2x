The sql script is billing_script.sql

The starting page for the module is billingmenu.php

This interface consists of enter new/edit existing hospital services, enter new/edit existing laboratory services and search for a patient to perform operations relating to the patient.

The interface after searching/selecting a patient gives user the options of associating the patient with hospital and lab services, view his bills and payments, accepting a new payment and generate the final bill.

The bills are can be generated a items which are unbilled as yet. Payment can be accepted at any time and is
not corresponding to any bill.

The bill shows the total amount, outstanding (calculated as total bill amount till the last bill minus the total payment recieved from the patient, if negative it shows a zero) and the amount due is current bill amount plus outstanding.

The final bill should be generated only after all the services that the patient used are already billed. This check though is not done yet. There is the option offering discount on the final bill and also accepting payment.
The transaction for the final bill is recorded in care_billing_final table and money recieved against the final bill is not recorded in care_billing_payment table yet.

The following are the limitations or drawbacks as percieved now:

1. The final bill is generated with assumption that all items/services that the patient used are already been billed.
2. The links to go back to the parent menu's are not included.
3. Email functions are not ready.
4. The footer of the pages is not correct.
5. Decimal section not corrected to 2 places.
6. Alignments of some columns are not uniform.
7. Validation in input fields are not complete.
8. The final bill interface though is a statement, but it will be able to accept payment. This payment is not recorded in the care_billing_payment but in care_billing_final table.
9. The print functions are not working smoothly, works for windows only.
10. Access to all the pages are open.
11. We couldn't locate In-Patient and out-Patient differentitaion in the existing module so the patient type field in the patient information section of the bills is given as first name.
12. The currency notation has not been included.
13. Language, SID and cookies are not taken into account.

----------------------------------------
eComBill by www.ecomscience.com (April 2003)
