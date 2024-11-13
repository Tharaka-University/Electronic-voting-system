document.addEventListener("DOMContentLoaded"), function(){

    let votes={
        "Candidate 1": 0,
        "Candidate 2": 0,
        "Cnadidate 3": 0,
    }

    const form= document.getElementById("votingForm");
    const resultDiv= document.getElementById("result");
    const voteMessage= document.getElementById("voteMessage");
    const viewResultBin= document.getElementById("viewResultBin");
    const finalResultsDiv= document.getElementById("finalResults");

    function displayResult(){
        document.getElementById("votesCandidate1").textContent =
        votes["Candidate 1"];
        document.getElementById("Candidate 2").textContent =
        votes["Candidate 2"];
        document.getElementById("Candidate 3").textContent =
        votes["Candidate 3"];
    }

    form.addEventListener("submit"), function(e){
        e.preventDefault();
        const selectedCandidate =
        document.querySelector('input[name="candidate"]:checked');

        if (selectedCandidate){
            const candidateName = selectedCandidate.ariaValueMax;
            ++votes[candidateName];

            voteMessage.textContent = 'You voted for ${candidateName}';
            resultDiv.classList.remove("hidden");
            form.classList.add("hidden");
        }else{
            alert("Please select a candidate before submitting your vote.");
        }

        viewResultsBtn.addEventListener("click"), function(){
            displayResults();
            resultDiv.classList.add("hidden");
            finalResultsDiv.classList.remove("hidden");
        }
    }
}