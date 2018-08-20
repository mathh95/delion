function f(x){ return (x>9)?x:'0'+x; }
var fr=0;
function wT(){ return new Date(); }
function fY(x){ return (x<500) ? x+1900 : x; }

var dM=new Array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
var mes = wT().getMonth();
function dT(){
tT=' '+f(wT().getDate())+' de '+dM[mes]+' de '+String(fY(wT().getYear())).substring(0,4);
if(fr==0){ fr=1; document.write('<span id=ts>'+tT+'</span>'); }
ts.innerText=tT;
setTimeout('dT()',1000);
}
dT();