let canvasContainer;
let mainCanvas, mainContext, animationID, lastTime;
let curveGens = [];
const curveAmount = 30;
const segmentAmount = 20;
const minCurveRange = 50;
//const curveOffsetIncr = 15;
const canvPadMult = 0.0;//0.4;
const resizeCheckDur = 2000;
let resizeInterval;
let lastWindowWidth = window.innerWidth;

let typedTextElements, textsToType, textCursor;
const typeSpeed = 130;
const typeWordPause = 800;
const caretSpeed = 1000;
let wordIndex = 0;
let letterIndex = 0;

window.addEventListener('DOMContentLoaded', () =>
{
    mainCanvas = document.querySelector('#mainCanvas');
    mainContext = mainCanvas.getContext('2d');
    if(!mainCanvas)
    {
        return;
    }

    canvasContainer = document.querySelector('.canvas-container');
    resizeCanvas();
    startCurveGen();
    startResizeInterval();

    startTyping();
})

function startResizeInterval()
{    
    resizeInterval = setInterval(() =>
    {   
        if(window.innerWidth != lastWindowWidth)
        {
            destroyCurves();
            resizeCanvas();
            startCurveGen();
            lastWindowWidth = window.innerWidth;
            clearInterval(resizeInterval);  
            startResizeInterval();      
        }        
    }, resizeCheckDur);
}

function startTyping()
{
    typedTextElements = [];
    let i = 0;
    while(true)
    {
        const el = document.querySelector('.js-typed-text-' + i);
        if(!el)
        {
            break;
        }
        typedTextElements.push(el);
        ++i;
    }
    if(typedTextElements.length == 0)
    {
        return;
    }

    textsToType = Array.from(typedTextElements).map((element) => element.innerText);
    typedTextElements.forEach((element) => element.textContent = " ");
    textCursor = document.querySelector('.js-text-cursor');
    typeText();
}

function typeText()
{
    const content = textsToType[wordIndex];
    let speed = typeSpeed;

    if(wordIndex > 0 && letterIndex == 0) //move cursor at start of new word
    {
        //console.log(textCursor, typedTextElements[wordIndex].node);
        textCursor.remove();
        typedTextElements[wordIndex].parentNode.appendChild(textCursor);
        //typedTextElements[wordIndex].appendChild(textCursor);
    }

    if(letterIndex >= content.length)
    {
        letterIndex = 0;
        wordIndex++;
        if(wordIndex >= typedTextElements.length)
        {
            return;
        }
        else
        {            
            speed = typeWordPause;
        }
    }
    else
    {        
        typedTextElements[wordIndex].textContent += content[letterIndex];
        letterIndex++;
    }
    setTimeout(typeText, speed);
}

function destroyCurves()
{
    if(animationID)
    {
        cancelAnimationFrame(animationID);
        animationID = null;
    }
    mainContext.clearRect(0, 0, mainCanvas.width, mainCanvas.height);
    curveGens = [];
}

function resizeCanvas() 
{
    //setting width/height here makes the canvas parameters useable elsewhere
    mainCanvas.width = window.innerWidth * 1.0; // 80% of the viewport width
    mainCanvas.height = window.innerHeight * 1.0; // 80% of the viewport height
}

function startCurveGen()
{
    const canvW = mainCanvas.width;
    const horPadding = canvW * canvPadMult;
    const canvMinusPad = canvW - horPadding * 2;
    const incr = canvMinusPad / curveAmount;
    //const incr = horPadding / (curveAmount * 0.5);

    for(let i = 0; i < curveAmount; ++i)
    {
        const xOffset = incr * i + incr * 0.5 + horPadding;
        
        //const gapOffset = (canvW - horPadding) * Math.floor(i / (curveAmount / 2));
        //const xOffset = incr * (i % (curveAmount / 2)) + gapOffset + incr * 0.5; 


        //console.log("xOffset " + i % (curveAmount / 2), xOffset, gapOffset, canvW - horPadding, Math.floor(i / (curveAmount / 2)));
        // const curveGen = new CurveGenerator(curveOffsetIncr * i + 100, 0, 50, 70, getRandomColor());
        const curveGen = new CurveGenerator(xOffset, 0, Math.max(incr, minCurveRange), 70, getRandomColor());
        curveGen.generateCurves(segmentAmount);
        curveGens.push(curveGen);    
    }    
    
    requestAnimationFrame(firstFrame);
}

function firstFrame(timeStamp)
{
  lastTime = timeStamp;
  animate(timeStamp);
}

function getRandomColor()
{
    const letters = '01234567890ABCDEF';
    let color = '#';
    for(let i = 0; i < 6; ++i)
    {
        color += letters[Math.floor(Math.random() * letters.length)];
    }
    return color;
}

class CurveGenerator
{
    #color;
    #horRange;
    #verRange;
    #offsetX; 
    #offsetY;
    #t = 0;
    #curveIndex = 0;
    #curves = [];
    #circles = [];
    #isDrawingCurve = false;
    #stepSize = 0.03;

    isCurveDone = false;

    constructor(x, y, w, h, c)
    {
        this.#color = c;
        this.#offsetX = x;
        this.#offsetY = y;
        this.#horRange = w;
        this.#verRange = h;
    }
    generateCurves(amount)
    {
        let sx, sy, cx, cy, ex, ey;
        sx = this.#offsetX; //this.#canvas.width / 2.0;
        sy = 0;
        for(let i = 0; i < amount; ++i)
        {
            const step = Math.random() >= 0.33;
    
            cx = step ? sx : sx + (Math.random() - 0.5) * this.#horRange;
            cy = step ? sy + Math.random() * this.#verRange * 0.8 + this.#verRange * 0.2
                : sy + Math.random() * this.#verRange * 0.5;
            ex = cx + (Math.random() - 0.5) * this.#horRange;
            ey = step ? cy : cy + Math.random() * this.#verRange;
    
            const c = { startX: sx, startY: sy, controlX: cx, controlY: cy, endX: ex, endY: ey, 
                isStep: step, speed: Math.random() * 0.002 + 0.0005 };
            //console.log(c);
            this.#curves.push(c);
            //console.log("curve " + i, c);
            sx = ex;
            sy = ey;
        }
    }

    #drawCircle(curve, progress) 
    {
        mainContext.beginPath();
        mainContext.arc(curve.startX, curve.startY, 3 * progress, 0, 2 * Math.PI); // Center at (startX, startY), radius 10
        mainContext.fillStyle = this.#color; // Optional: Set the fill color
        mainContext.strokeStyle = this.#color;
        mainContext.fill(); // Fill the circle
        mainContext.stroke(); // Outline the circle
    }

    #drawCurveSegment(curve, progress, stepSize) 
    {
        if(curve.startY > mainCanvas.height)
        {
            this.isCurveDone = true;
            return;
        }
        mainContext.beginPath();
        mainContext.moveTo(curve.startX, curve.startY); // Starting point
        mainContext.lineWidth = 3 * (mainCanvas.width / 800);
        mainContext.strokeStyle = this.#color;

        progress = Math.min(progress, 1.0);
        // Draw the curve up to the specified progress
        if (progress === 1) 
        {
            if (curve.isStep) 
            {
                mainContext.lineTo(curve.controlX, curve.controlY);
                mainContext.lineTo(curve.endX, curve.endY);
            } 
            else 
            {
                mainContext.quadraticCurveTo(curve.controlX, curve.controlY, curve.endX, curve.endY);
            }
        } 
        else 
        {            
            let currentX, currentY;
            if(curve.isStep)
            {
                const vLength = curve.endY - curve.startY; // Vertical length
                const hLength = curve.endX - curve.startX; // Horizontal length
                const totalLength = vLength + Math.abs(hLength);
        
                const verticalFraction = vLength / totalLength; // Fraction of vertical segment
                const horizontalFraction = Math.abs(hLength) / totalLength; // Fraction of horizontal segment

                const verticalProgress = Math.min(progress / verticalFraction, 1.0);
                const horizontalProgress = (progress - verticalFraction) / horizontalFraction;
                //let reachedCorner = false;

                currentX = curve.controlX;
                currentY = vLength * verticalProgress + curve.startY; //
                
                //console.log(verticalFraction, horizontalFraction);//, "prog:", progress, "verProg:", verticalProgress, "horProg:", horizontalProgress);

                if(progress > verticalFraction)
                {
                    mainContext.lineTo(curve.controlX, curve.controlY);
                    currentX = curve.controlX + hLength * horizontalProgress; // 0.7 -> 0.1 -> 0.25
                    currentY = curve.endY;
                }                
                mainContext.lineTo(currentX, currentY);
            }
            else
            {
                for (let i = 0; i <= progress; i += stepSize)
                {
                    // Quadratic curve drawing logic
                    currentX = (1 - i) * (1 - i) * curve.startX + 2 * (1 - i) * i * curve.controlX + i * i * curve.endX;
                    currentY = (1 - i) * (1 - i) * curve.startY + 2 * (1 - i) * i * curve.controlY + i * i * curve.endY;
                    mainContext.lineTo(currentX, currentY);
                }
            }
        }
        mainContext.stroke();
    }
    
    #drawAllCurves() 
    {            
        // Redraw all completed curves
        for (let i = 0; i < this.#curveIndex; i++) 
        {
            this.#drawCurveSegment(this.#curves[i], 1);
        }
    
        // Redraw all circles
        //console.log(this.#circles);
        this.#circles.forEach(circle => this.#drawCircle(circle.curve, circle.progress));
    
        // Draw the current curve or circle up to the current progress
        if (this.#curveIndex < this.#curves.length) 
        {
            if (this.#isDrawingCurve) 
            {
                this.#drawCurveSegment(this.#curves[this.#curveIndex], this.#t, this.#stepSize);
            } 
            else 
            {
                this.#drawCircle(this.#curves[this.#curveIndex], this.#t);
            }
        }
        else
        {
            this.isCurveDone = true;
            //this.stopAnimation();
        }
    }
    draw(delta) 
    {
        const speed = this.#isDrawingCurve ? this.#curves[this.#curveIndex].speed : 0.003; // Constant speed of drawing
        this.#t += (speed * delta); // Scale based on time (delta in milliseconds)
        //this.#t += incr * delta;//(delta / fixedDelta); // Increment the progress based on fixed time step
        if (!this.isCurveDone && this.#t > 1) 
        {
            this.#t = 0; // Reset progress for the next curve or circle
            if (this.#isDrawingCurve) 
            {
                this.#curveIndex++; // Move to the next curve after the circle is drawn
            } 
            else 
            {
                this.#circles.push({ curve: this.#curves[this.#curveIndex], progress: 1 }); // Save the completed circle
            }
            this.#isDrawingCurve = !this.#isDrawingCurve;
        }
        
        // * 0.5; // Calculate step size proportional to fixed time step
        
        this.#drawAllCurves();
        if (this.#curveIndex >= this.#curves.length) 
        {
            this.isCurveDone = true;
        //this.#animationID = requestAnimationFrame(() => this.animate()); // Continue the animation
        }
        return this.#t;
    }
}

function animate(timeStamp) 
{    
    const currentTime = timeStamp;
    const delta = currentTime - lastTime;
    let isAllCurvesDone = true;
    for(let i = 0; i < curveGens.length; ++i)
    {
        if(!curveGens[i].isCurveDone)
        {
            isAllCurvesDone = false;
            break;
        }
    }
    if(isAllCurvesDone)
    {
        cancelAnimationFrame(animationID);
        curveGens = [];
        return;
    }
    mainContext.clearRect(0, 0, mainCanvas.width, mainCanvas.height); // Clear the main canvas

   // let debT;
    for(let i = 0; i < curveGens.length; i++)
    {
        curveGens[i].draw(delta);
    }

    const id = requestAnimationFrame((t) => animate(t)); // Continue the animation
    if(!animationID)
    {
        animationID = id;
    }
    //console.log("scg, animID", animationID);
    lastTime = currentTime;
}