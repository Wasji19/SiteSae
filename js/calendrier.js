let Cases = document.getElementsByClassName('case')

let date = new Date();
let year = date.getFullYear();
let month = date.getMonth() + 1;
let day = date.getDate();

const monthName= ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

const UP_MONTH = 'upMonth'
const DOWN_MONTH = 'downMonth'

function CALENDRIER_REDUCER(action){
    switch(action){
        case UP_MONTH:
            if(month <12 ) month++
            else{
                year++
                month=1
            }
            break;
        case DOWN_MONTH:
            if(month > 0 ) month--
            else{
                year--
                month = 12
            }
            break;


        default:
            break;
    }
    calendrier(year,month)
}

document.getElementById('avant').onclick= function(){
    CALENDRIER_REDUCER(DOWN_MONTH)
    console.log(month)
}

document.getElementById('apres').onclick= function(){
    CALENDRIER_REDUCER(UP_MONTH)
    console.log(month)
}

function calendrier(year,month){
    const monthNB = month + 12 * (year - 2020 )

    let cld = [{dayStart:2, length:31, year:2020, month: "Janvier"}]

    for (let i =0; i <  monthNB - 1 ; i++) {                                         
        let yearSimulé = 2020 + Math.floor(i / 12)
        const monthsSimuléLongueur = [31, getFévrierLength(yearSimulé), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ]
        let monthSimuléIndex = (i+1) - (yearSimulé-2020) * 12

        cld[i+1]={
            dayStart: (cld[i].dayStart + monthsSimuléLongueur[monthSimuléIndex - 1]) % 7,
            length: monthsSimuléLongueur[monthSimuléIndex],
            year: 2020 + Math.floor((i+1) / 12 ),
            month: monthName[monthSimuléIndex]
        }

        if(cld[ i + 1].month == undefined){
            cld[ i + 1].month = "Janvier"
            cld[ i + 1].length = 31 
        }
    }

    for(let i = 0; i < Cases.length; i++){
        Cases[i].innerText = ""
    }

    for(let i = 0; i <cld[cld.length - 1 ].length; i++){
        Cases[i + cld[cld.length - 1].dayStart].innerText = i +1
    }

    document.getElementById('cldT').innerText = cld[cld.length - 1 ].month.toLocaleUpperCase() + " " + cld[cld.length - 1].year
    
    
    
}
calendrier(year,month)

function getFévrierLength(year){
    if(year % 4 ==0 )
        return 29
    else return 28
}