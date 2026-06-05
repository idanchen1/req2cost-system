// Function to analyze selected requirements
function analyzeProject() {
    var checkboxes = document.querySelectorAll('.req-checkbox');
    var totalCost = 0;
    var requiredBlocks = []; // Array requirement

    // Standard FOR loop requirement and IF condition
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            totalCost += parseInt(checkboxes[i].value);
            requiredBlocks.push(checkboxes[i].getAttribute('data-block'));
        }
    }

    var resultBox = document.getElementById("analysisResult");
    var blocksList = document.getElementById("blocksList");
    var costDisplay = document.getElementById("totalCostDisplay");

    blocksList.innerHTML = "";

    if (totalCost === 0) {
        alert("Please select at least one capability for the project.");
        resultBox.style.display = "none";
        return;
    }

    // Populate the list
    for (var j = 0; j < requiredBlocks.length; j++) {
        var li = document.createElement("li");
        li.textContent = requiredBlocks[j];
        blocksList.appendChild(li);
    }

    // JS Output Requirement: console.log
    console.log("System Analysis Complete. Total Estimated Cost: $" + totalCost);

    // JS Output Requirement: innerHTML
    var costString = "Estimated Total Cost: $" + totalCost.toLocaleString(); // String requirement
    costDisplay.textContent = costString;
    
    resultBox.style.display = "block";
}

function toggleSecretMode() {
    var secretSection = document.getElementById("secretSection");
    if (secretSection.style.display === "none") {
        secretSection.style.display = "block";
        alert("Secret Mode Activated: Classified Radar Integration Unlocked.");
    } else {
        secretSection.style.display = "none";
    }
}

function calculateEstimate() {
    var selectedValue = document.getElementById("systemType").value;
    var resultOutput = document.getElementById("resultMessage");

    if (selectedValue === "") {
        resultOutput.innerHTML = "Error: Please select a system complexity level first.";
        resultOutput.style.color = "red";
    } else {
        resultOutput.innerHTML = "Estimated Base Cost: $" + selectedValue + "<br>For an exact quote, please start a New Project.";
        resultOutput.style.color = "green";
    }
}

function toggleSkills() {
    var skillsList = document.getElementById("skillsList");
    var btn = document.getElementById("skillsBtn");

    if (skillsList.style.display === "none") {
        skillsList.style.display = "block";
        btn.value = "Hide Technical Skills";
    } else {
        skillsList.style.display = "none";
        btn.value = "Show Technical Skills";
    }
}