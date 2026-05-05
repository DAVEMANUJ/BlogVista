<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $admit   = Category::where('slug', 'admit-card')->first()->id;
        $result  = Category::where('slug', 'result')->first()->id;
        $job     = Category::where('slug', 'job-alert')->first()->id;
        $syllabus = Category::where('slug', 'syllabus')->first()->id;
        $answer  = Category::where('slug', 'answer-key')->first()->id;
        $recruit = Category::where('slug', 'recruitment')->first()->id;

        $blogs = [
            [
                'title'             => 'SSC CGL 2024 Admit Card Released – Download Now',
                'short_description' => 'The Staff Selection Commission has released the SSC CGL 2024 Tier-I admit card. Candidates can now download it from the official portal using registration number and date of birth.',
                'content'           => '<p>The <strong>Staff Selection Commission (SSC)</strong> has officially released the Admit Card for the Combined Graduate Level (CGL) 2024 Tier-I Examination. Candidates who applied for the examination can now download their admit cards from the official website.</p>
<h3>How to Download SSC CGL 2024 Admit Card</h3>
<ol>
<li>Visit the official SSC website at <strong>ssc.gov.in</strong></li>
<li>Click on the "Admit Card" section on the homepage</li>
<li>Select "SSC CGL 2024 Tier-I Admit Card"</li>
<li>Enter your Registration Number and Date of Birth</li>
<li>Download and print your admit card</li>
</ol>
<h3>Important Details on Admit Card</h3>
<p>Candidates must carefully verify all details printed on the admit card including name, roll number, date of birth, examination center, and reporting time. Any discrepancy should be reported to SSC immediately.</p>
<h3>Documents Required at Exam Center</h3>
<ul>
<li>Printed Admit Card (A4 size, clear print)</li>
<li>One original government-issued photo ID (Aadhaar, PAN, Passport, Voter ID)</li>
<li>Two recent passport-size photographs</li>
</ul>
<p>Candidates are advised to reach the examination center at least 30 minutes before the reporting time. Mobile phones and electronic gadgets are strictly prohibited inside the exam hall.</p>',
                'category_id'       => $admit,
                'published_at'      => '2024-03-15',
            ],
            [
                'title'             => 'UPSC Civil Services Prelims 2024 Result Announced',
                'short_description' => 'UPSC has declared the Civil Services Preliminary Examination 2024 result. Over 14,000 candidates have qualified for the Mains examination. Check your roll number in the official PDF.',
                'content'           => '<p>The <strong>Union Public Service Commission (UPSC)</strong> has announced the result of the Civil Services (Preliminary) Examination 2024. Candidates who appeared in the exam can check whether they have qualified for the Main Examination.</p>
<h3>Result Statistics</h3>
<p>A total of <strong>14,624 candidates</strong> have been shortlisted to appear in the Civil Services (Main) Examination 2024. The result PDF containing roll numbers of qualified candidates is available on the official UPSC website.</p>
<h3>How to Check UPSC Prelims 2024 Result</h3>
<ol>
<li>Go to <strong>upsc.gov.in</strong></li>
<li>Click on "What\'s New" or "Results" section</li>
<li>Look for "Civil Services (Preliminary) Examination 2024"</li>
<li>Download the PDF and search for your Roll Number using Ctrl+F</li>
</ol>
<h3>Next Steps for Qualified Candidates</h3>
<p>Candidates who have cleared the Preliminary Examination must now start preparing for the <strong>Civil Services Main Examination</strong>. The Mains consists of 9 papers including Essay, General Studies (I to IV), and two Optional Subject papers.</p>
<p>The detailed application form (DAF) for the Main Examination will be available shortly on the official website. Qualified candidates must fill in the DAF within the prescribed time limit.</p>',
                'category_id'       => $result,
                'published_at'      => '2024-04-02',
            ],
            [
                'title'             => 'Indian Railway Recruitment 2024 – 9000+ Vacancies for Group D',
                'short_description' => 'Railway Recruitment Boards have announced Group D vacancies for 2024. Eligible candidates with 10th pass qualification can apply online before the deadline. Total 9,144 posts available.',
                'content'           => '<p>The <strong>Railway Recruitment Boards (RRBs)</strong> across India have announced recruitment for Group D (Level-1) posts under the Central Government. This is a major opportunity for candidates who have completed their Class 10 education.</p>
<h3>Vacancy Details</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
<tr style="background:#f3f4f6;"><th>Category</th><th>Posts</th></tr>
<tr><td>Track Maintainer Grade-IV</td><td>3,445</td></tr>
<tr><td>Helper/Assistant in Engineering</td><td>2,110</td></tr>
<tr><td>Helper/Assistant in Electrical</td><td>1,876</td></tr>
<tr><td>Helper/Assistant in Signal & Telecom</td><td>1,713</td></tr>
</table>
<h3>Eligibility Criteria</h3>
<ul>
<li><strong>Educational Qualification:</strong> 10th Standard Pass from a recognized board</li>
<li><strong>Age Limit:</strong> 18 to 33 years (relaxation as per government norms)</li>
<li><strong>Nationality:</strong> Indian Citizen</li>
</ul>
<h3>Selection Process</h3>
<p>The selection process consists of Computer Based Test (CBT), Physical Efficiency Test (PET), Document Verification, and Medical Examination. Candidates must qualify each stage to proceed to the next.</p>
<h3>Application Fee</h3>
<p>General/OBC: ₹500 | SC/ST/PwBD/Female/Minority/EBC: ₹250 (refundable upon appearing in CBT Stage-1)</p>',
                'category_id'       => $job,
                'published_at'      => '2024-04-10',
            ],
            [
                'title'             => 'IBPS PO 2024 Syllabus – Complete Topic-wise Guide',
                'short_description' => 'Preparing for IBPS PO 2024? Here is the complete and updated syllabus for Prelims and Mains examination. Understand the exam pattern, important topics, and marking scheme.',
                'content'           => '<p>The <strong>Institute of Banking Personnel Selection (IBPS)</strong> conducts the Probationary Officer (PO) examination every year for recruitment in various public sector banks. Here is the complete updated syllabus for IBPS PO 2024.</p>
<h3>IBPS PO Prelims Syllabus</h3>
<p>The Preliminary Examination consists of three sections totaling 100 marks with a duration of 1 hour:</p>
<ul>
<li><strong>English Language:</strong> Reading Comprehension, Cloze Test, Para Jumbles, Fill in the blanks, Error Detection (30 questions, 30 marks)</li>
<li><strong>Quantitative Aptitude:</strong> Simplification, Number Series, Data Interpretation, Quadratic Equations, Arithmetic (35 questions, 35 marks)</li>
<li><strong>Reasoning Ability:</strong> Puzzles & Seating Arrangement, Blood Relations, Direction Sense, Coding-Decoding, Inequality (35 questions, 35 marks)</li>
</ul>
<h3>IBPS PO Mains Syllabus</h3>
<p>The Main Examination consists of 4 objective sections + 1 descriptive test:</p>
<ul>
<li><strong>Reasoning & Computer Aptitude:</strong> Advanced Puzzles, Machine Input-Output, Computer Fundamentals (45 questions, 60 marks)</li>
<li><strong>English Language:</strong> Reading Comprehension, Editorial, Vocabulary (35 questions, 40 marks)</li>
<li><strong>Data Analysis & Interpretation:</strong> Caselet DI, Charts, Mixed DI (35 questions, 60 marks)</li>
<li><strong>General/Economy/Banking Awareness:</strong> Current Affairs, Banking Terminology, Financial Awareness (40 questions, 40 marks)</li>
</ul>
<h3>Important Exam Tips</h3>
<p>Focus on accuracy over speed for Prelims. For Mains, practice DI sets and Puzzles extensively as they carry maximum weightage. Start descriptive writing practice from day one—letter writing and essay are often neglected but are important differentiators.</p>',
                'category_id'       => $syllabus,
                'published_at'      => '2024-03-28',
            ],
            [
                'title'             => 'SSC CHSL 2023 Answer Key Released – Raise Objections by April 20',
                'short_description' => 'SSC has released the provisional answer key for CHSL 2023 Tier-I examination. Candidates can challenge incorrect answers online till April 20, 2024, by paying ₹100 per question.',
                'content'           => '<p>The <strong>Staff Selection Commission (SSC)</strong> has released the provisional answer key for the Combined Higher Secondary Level (CHSL) 2023 Tier-I Computer Based Examination. Candidates who appeared in the examination can now view and challenge the answer key.</p>
<h3>How to View & Challenge Answer Key</h3>
<ol>
<li>Login to your SSC account at <strong>ssc.gov.in</strong></li>
<li>Go to "Candidate Login" and enter your credentials</li>
<li>Navigate to "Answer Key" section</li>
<li>Your question paper and responses will be displayed</li>
<li>Click on "Challenge" against any question you wish to dispute</li>
<li>Pay ₹100 per question as challenge fee</li>
</ol>
<h3>Important Dates</h3>
<ul>
<li>Answer Key Release Date: April 15, 2024</li>
<li>Last Date to Raise Objections: April 20, 2024 (11:00 PM)</li>
<li>Refund of Fee: Only for accepted challenges</li>
</ul>
<h3>How to Challenge Effectively</h3>
<p>Before raising a challenge, cross-verify the answer from authentic sources such as NCERT textbooks, official government publications, or standard reference books. Baseless challenges will not be accepted and the fee will be forfeited. Only submit a challenge if you are confident with a valid supporting reference.</p>
<p>The final answer key will be released after the SSC review committee evaluates all objections. The result will be prepared based on the final answer key only.</p>',
                'category_id'       => $answer,
                'published_at'      => '2024-04-15',
            ],
            [
                'title'             => 'BPSC 70th Integrated Combined Competitive Exam – Full Notification',
                'short_description' => 'Bihar Public Service Commission has released the notification for 70th BPSC Integrated examination. 1929 vacancies across various departments. Last date to apply is May 10, 2024.',
                'content'           => '<p>The <strong>Bihar Public Service Commission (BPSC)</strong> has published the official notification for the 70th Integrated Combined (Preliminary) Competitive Examination. This is one of the most anticipated state-level competitive exams for candidates seeking prestigious government jobs in Bihar.</p>
<h3>Vacancy Breakdown by Department</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%;border-collapse:collapse;">
<tr style="background:#f3f4f6;"><th>Department</th><th>Posts</th></tr>
<tr><td>Bihar Administrative Service</td><td>334</td></tr>
<tr><td>Bihar Police Service</td><td>196</td></tr>
<tr><td>Block/Sub-Divisional Officer</td><td>158</td></tr>
<tr><td>District Commandant Home Guard</td><td>47</td></tr>
<tr><td>Revenue Officer / Sub-Collector</td><td>229</td></tr>
<tr><td>Other Posts</td><td>965</td></tr>
</table>
<h3>Eligibility</h3>
<ul>
<li><strong>Education:</strong> Bachelor\'s degree from any recognized University</li>
<li><strong>Age:</strong> 20-37 years (Gen), 20-40 years (BC/EBC), 20-42 years (SC/ST/Female)</li>
</ul>
<h3>Exam Pattern</h3>
<p>The Preliminary examination consists of a single paper of General Studies for 150 marks (150 questions), duration 2 hours. There is no negative marking. The Mains consists of General Hindi, Essay, General Studies I & II, and Optional Subject paper.</p>
<h3>Application Process</h3>
<p>Applications must be submitted online through <strong>bpsc.bih.nic.in</strong>. Application fee is ₹600 for General/BC/EBC and ₹150 for SC/ST/PwBD of Bihar domicile. Candidates are advised to apply well before the last date to avoid server congestion.</p>',
                'category_id'       => $recruit,
                'published_at'      => '2024-04-20',
            ],
            [
                'title'             => 'NEET UG 2024 Admit Card – Download Direct Link Active',
                'short_description' => 'NTA has activated the NEET UG 2024 admit card download link. The exam is scheduled for May 5, 2024. Candidates must report at the center 90 minutes before the exam start time.',
                'content'           => '<p>The <strong>National Testing Agency (NTA)</strong> has made the NEET UG 2024 Admit Card available for download. Candidates who have registered for the National Eligibility cum Entrance Test (Undergraduate) 2024 can download their hall tickets from the official portal.</p>
<h3>NEET UG 2024 Key Details</h3>
<ul>
<li><strong>Exam Date:</strong> May 5, 2024 (Sunday)</li>
<li><strong>Exam Duration:</strong> 3 hours 20 minutes (2:00 PM to 5:20 PM)</li>
<li><strong>Mode:</strong> Offline (Pen and Paper Based)</li>
<li><strong>Total Marks:</strong> 720 (180 questions × 4 marks)</li>
<li><strong>Negative Marking:</strong> -1 for every wrong answer</li>
</ul>
<h3>Download Steps</h3>
<ol>
<li>Visit <strong>neet.nta.nic.in</strong></li>
<li>Click on "Download Admit Card"</li>
<li>Enter Application Number and Date of Birth / Password</li>
<li>Download and take a color printout</li>
</ol>
<h3>Important Instructions for Exam Day</h3>
<p>Candidates must carry a valid photo ID along with the admit card. Items like mobile phones, smartwatches, calculators, and any electronic devices are strictly not allowed inside the examination hall. Transparent water bottles and transparent ball-point pens are permitted.</p>
<p>Since NEET is conducted across thousands of centers nationwide, candidates should locate their exact exam center in advance and plan their travel accordingly.</p>',
                'category_id'       => $admit,
                'published_at'      => '2024-04-25',
            ],
            [
                'title'             => 'SBI Clerk 2024 Result Out – Check Prelims Scorecard',
                'short_description' => 'State Bank of India has declared the SBI Clerk Preliminary Examination 2024 result. Candidates can check their scores and download scorecards. Mains exam date announced.',
                'content'           => '<p>The <strong>State Bank of India (SBI)</strong> has officially released the results for the SBI Clerk (Junior Associate) Preliminary Examination 2024. Candidates who appeared in the exam can now view their sectional and overall scores from the official SBI careers portal.</p>
<h3>Result Highlights</h3>
<ul>
<li>Total applicants: 25.6 Lakh (approx.)</li>
<li>Candidates appeared: ~14 Lakh</li>
<li>Candidates qualified for Mains: 3x to 5x times the vacancy in each state</li>
</ul>
<h3>How to Check Your Result</h3>
<ol>
<li>Visit <strong>sbi.co.in/careers</strong></li>
<li>Click on "Recruitment of Junior Associates – Prelims Result 2024"</li>
<li>Login with your Registration Number / Roll Number and Password / DOB</li>
<li>Your Scorecard will be displayed — note the marks scored in each section</li>
</ol>
<h3>Sectional Cut-offs (Approximate)</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%;border-collapse:collapse;">
<tr style="background:#f3f4f6;"><th>Section</th><th>Max Marks</th><th>Approx Cutoff (Gen)</th></tr>
<tr><td>English Language</td><td>30</td><td>8–10</td></tr>
<tr><td>Numerical Ability</td><td>35</td><td>10–12</td></tr>
<tr><td>Reasoning</td><td>35</td><td>10–12</td></tr>
</table>
<h3>Mains Examination</h3>
<p>The SBI Clerk Main Examination 2024 is tentatively scheduled for June 2024. Qualified candidates must start focusing on General/Financial Awareness and Computer Aptitude sections which appear exclusively in the Mains.</p>',
                'category_id'       => $result,
                'published_at'      => '2024-05-01',
            ],
            [
                'title'             => 'UPSC CAPF 2024 Recruitment – Apply for 506 Assistant Commandant Posts',
                'short_description' => 'UPSC has released the notification for CAPF (AC) 2024. 506 vacancies for Assistant Commandant posts in BSF, CRPF, CISF, ITBP & SSB. Online application window opens May 8.',
                'content'           => '<p>The <strong>Union Public Service Commission (UPSC)</strong> has released the notification for the Central Armed Police Forces (Assistant Commandants) Examination 2024. This is a prestigious central government recruitment for officer-level positions in India\'s paramilitary forces.</p>
<h3>Force-wise Vacancies</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%;border-collapse:collapse;">
<tr style="background:#f3f4f6;"><th>Force</th><th>Vacancies</th></tr>
<tr><td>Border Security Force (BSF)</td><td>150</td></tr>
<tr><td>Central Reserve Police Force (CRPF)</td><td>109</td></tr>
<tr><td>Central Industrial Security Force (CISF)</td><td>102</td></tr>
<tr><td>Indo-Tibetan Border Police (ITBP)</td><td>79</td></tr>
<tr><td>Sashastra Seema Bal (SSB)</td><td>66</td></tr>
</table>
<h3>Eligibility Requirements</h3>
<ul>
<li><strong>Education:</strong> Bachelor\'s Degree from any recognized University</li>
<li><strong>Age:</strong> 20 to 25 years (as on August 1, 2024)</li>
<li><strong>Physical Standards:</strong> Height, chest measurements, and vision requirements apply</li>
</ul>
<h3>Selection Process</h3>
<ol>
<li>Written Examination (Paper-I: General Ability & Intelligence; Paper-II: General Studies)</li>
<li>Physical Standards Test (PST) / Physical Efficiency Test (PET)</li>
<li>Medical Examination</li>
<li>Personal Interview/Personality Test</li>
</ol>
<p>The written examination is scheduled for August 4, 2024. The application fee is ₹200 (SC/ST/Female candidates are exempted). Applications must be submitted online at <strong>upsconline.nic.in</strong>.</p>',
                'category_id'       => $recruit,
                'published_at'      => '2024-05-05',
            ],
            [
                'title'             => 'GATE 2025 Syllabus Released – All Branches Updated PDF',
                'short_description' => 'IIT Roorkee has released the official GATE 2025 syllabus for all 30 papers. Key changes in CS, ME, EE and Civil branches. Download branch-wise syllabus PDF from the official site.',
                'content'           => '<p><strong>IIT Roorkee</strong>, the organizing institute for GATE 2025, has officially released the syllabus for all 30 papers. Candidates appearing for the Graduate Aptitude Test in Engineering (GATE) 2025 should review the updated syllabus and note any changes from previous years.</p>
<h3>Key Changes in GATE 2025 Syllabus</h3>
<ul>
<li><strong>Computer Science (CS):</strong> Addition of topics on Machine Learning fundamentals and updated Data Structure problems</li>
<li><strong>Electrical Engineering (EE):</strong> Power Electronics section slightly reordered; Power Systems updated</li>
<li><strong>Mechanical (ME):</strong> Engineering Mechanics section restructured for clarity</li>
<li><strong>Civil Engineering (CE):</strong> Environmental Engineering sub-topics expanded</li>
</ul>
<h3>Common GATE Syllabus (All Papers)</h3>
<p>Every GATE paper includes <strong>General Aptitude (GA)</strong> section with 15 marks — covering Verbal Ability (English grammar, sentence completion, verbal analogies, critical reasoning) and Numerical Ability (numerical computation, numerical estimation, data interpretation).</p>
<h3>GATE 2025 Important Dates</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%;border-collapse:collapse;">
<tr style="background:#f3f4f6;"><th>Event</th><th>Date</th></tr>
<tr><td>Application Opens</td><td>August 28, 2024</td></tr>
<tr><td>Application Closes</td><td>September 26, 2024</td></tr>
<tr><td>Admit Card Release</td><td>January 2025</td></tr>
<tr><td>Examination</td><td>February 1–2, 8–9, 2025</td></tr>
<tr><td>Result Declaration</td><td>March 19, 2025</td></tr>
</table>',
                'category_id'       => $syllabus,
                'published_at'      => '2024-05-08',
            ],
            [
                'title'             => 'NDA 1 2024 Answer Key – Paper I & II Official Key Released',
                'short_description' => 'UPSC has released the official answer key for NDA & NA Examination (I) 2024. Candidates can challenge incorrect answers with proper justification. Check the marking scheme below.',
                'content'           => '<p>The <strong>Union Public Service Commission (UPSC)</strong> has released the official answer key for the National Defence Academy (NDA) & Naval Academy (NA) Examination (I) 2024. The examination was conducted on April 21, 2024.</p>
<h3>Answer Key Details</h3>
<p>The official answer key covers both sets of question papers:</p>
<ul>
<li><strong>Paper I – Mathematics:</strong> 120 questions, 300 marks</li>
<li><strong>Paper II – General Ability Test:</strong> 150 questions, 600 marks</li>
</ul>
<h3>Marking Scheme</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%;border-collapse:collapse;">
<tr style="background:#f3f4f6;"><th>Paper</th><th>Correct Answer</th><th>Wrong Answer</th><th>Unattempted</th></tr>
<tr><td>Mathematics (Paper I)</td><td>+2.5</td><td>-0.83</td><td>0</td></tr>
<tr><td>GAT (Paper II)</td><td>+4</td><td>-1.33</td><td>0</td></tr>
</table>
<h3>How to Challenge the Answer Key</h3>
<ol>
<li>Download the answer keys from <strong>upsc.gov.in</strong></li>
<li>Match with your recorded responses</li>
<li>If you believe an answer is incorrect, prepare a written representation with supporting evidence from standard textbooks</li>
<li>Submit the representation to UPSC at the address mentioned in the official notification</li>
</ol>
<p>Note: UPSC does not charge any fee for raising objections against the NDA answer key. However, all representations are subject to review by the subject matter experts, and UPSC\'s decision shall be final.</p>',
                'category_id'       => $answer,
                'published_at'      => '2024-04-30',
            ],
            [
                'title'             => 'CTET July 2024 Admit Card – Steps to Download Hall Ticket',
                'short_description' => 'CBSE has released the Central Teacher Eligibility Test (CTET) July 2024 admit card. Candidates can download the hall ticket using their application number and date of birth.',
                'content'           => '<p>The <strong>Central Board of Secondary Education (CBSE)</strong> has officially released the Admit Card for the Central Teacher Eligibility Test (CTET) July 2024. Candidates who have registered for both Paper I and Paper II can now download their admit cards.</p>
<h3>CTET 2024 Exam Schedule</h3>
<ul>
<li><strong>Paper I (Classes I–V):</strong> 9:30 AM to 12:00 PM</li>
<li><strong>Paper II (Classes VI–VIII):</strong> 2:00 PM to 4:30 PM</li>
<li><strong>Mode:</strong> Online (Computer Based Test)</li>
</ul>
<h3>Steps to Download Admit Card</h3>
<ol>
<li>Visit <strong>ctet.nic.in</strong></li>
<li>Click on "CTET July 2024 Admit Card" link</li>
<li>Enter Application Number and Date of Birth</li>
<li>Click "Submit" and your admit card will appear</li>
<li>Download and print on white A4 paper</li>
</ol>
<h3>Exam Day Guidelines</h3>
<ul>
<li>Reach center at least 30 minutes before exam start</li>
<li>Carry blue/black ball-point pen and pencil</li>
<li>Original Aadhaar / Voter ID mandatory for entry</li>
<li>No electronic devices allowed in the exam hall</li>
</ul>
<h3>About CTET Validity</h3>
<p>CTET certificate validity has been made <strong>lifetime</strong> as per the 2021 government circular. Candidates who qualified previously need not re-appear unless they wish to improve their scores. The CTET score is mandatory for teaching positions in Kendriya Vidyalayas, Navodaya Vidyalayas, and central government-aided schools.</p>',
                'category_id'       => $admit,
                'published_at'      => '2024-06-10',
            ],
        ];

        foreach ($blogs as $data) {
            $data['slug'] = Str::slug($data['title']);
            Blog::create($data);
        }
    }
}